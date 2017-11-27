<?php

abstract class Repository
{
    protected $model;
    protected $modelProperties;

    function __construct()
    {
        $this->model = $this->getRepositoryModel();
        $ref = new ReflectionClass($this->model);
        $props = array();
        foreach($ref->getProperties() as $property){
            $props[] = $property->getName();
        }
        $this->modelProperties = $props;
    }

    protected function db(){
        return new DatabaseConnector(PDO::FETCH_CLASS,$this->model);
    }

    function find(){
        $values = func_get_args();
        $identifiers = array_keys($this->getEntityMapping());

        if(count($values) != count($identifiers)){
            throw new Exception("Missing identifiers for find() functions, having ".count($values)." requires ". count($identifiers));
        }

        $cond = array();
        foreach ($values as $key => $value){
            $cond[] = "{$identifiers[$key]} = $value";
        }

        return $this->db()->select($this->modelProperties)->from($this->getModelTable())->where($cond)->getRow();
    }

    function findAll($_limit = 0,$_offset = 0){
        if(!empty($_limit)) {
            return $this->db()->select($this->modelProperties)->from($this->getModelTable())->limit($_limit)->offset($_offset)->getArray();
        }
        else{
            return $this->db()->select($this->modelProperties)->from($this->getModelTable())->getArray();
        }
    }

    function findOneBy($_criteria){
        $conditions = array();
        foreach ($_criteria as $column => $value){
            $conditions[] = "$column = $value";
        }
        return $this->db()->select($this->modelProperties)->from($this->getModelTable())->where($conditions)->getRow();
    }

    function findBy($_criteria){
        $conditions = array();
        foreach ($_criteria as $column => $value){
            $conditions[] = "$column = $value";
        }
        return $this->db()->select($this->modelProperties)->from($this->getModelTable())->where($conditions)->getArray();
    }

    function countAll(){
        return $this->db()->select("count(*)")->from($this->getModelTable())->getOne();
    }

    private function getRepositoryModel(){
        $repository = get_class($this);
        $modelName = ucwords(substr($repository,0,strpos($repository,"Repository")));
        $modelPath = __DIR__."/../models/$modelName.php";
        if(!file_exists($modelPath)){
            throw new Exception("Repository name ($repository) doesn't match any model.");
        }

        return $modelName;
    }

    protected function getModelTable(){
        $table = DatabaseConnector::tablelize("tbl{$this->model}");
        return $table;
    }

    public function persistAll($_entities){
        foreach ($_entities as $entity) {
            $this->persist($entity);
        }
    }

    /**
     * fixme: unstable, can't be used with association classes (multiple ids)
     * @param Entity $_entity
     */
    public function persist($_entity){

        $listOfTypes = array();
        $skipLookup = false;
        /**
         * @type Annotation[] $listOfIds
         */
        $listOfIds = $this->getEntityMapping();
        foreach ($listOfIds as $name => $id) {
            $type = $id->getParameter("type");
            $listOfTypes[$name] = !empty($type) ? $type : "manual";
            $getter = sprintf("get%s",ucfirst($name));
            $listOfIds[$name] = $_entity->$getter();

            switch ($listOfTypes[$name]){
                case "auto-increment":
                    if(empty($listOfIds[$name])){
                        $skipLookup = true;
                    }
                    break;
                case "manual":
                    if(empty($listOfIds[$name])){
                        throw new Exception("Id ($name) of type manual cannot be null.");
                    }
                    break;
                default:
                    throw new Exception("Identifier of type '{$listOfTypes[$name]}' is not valid.");
                    break;
            }
        }

        $result = false;
        if(!$skipLookup) {
            $result = $this->findOneBy($listOfIds);
        }

        if ($result) {
            $this->updateEntity($_entity);
        } else {
            $this->insertEntity($_entity);
        }
    }

    /**
     * @param Entity $_entity
     */
    private function updateEntity($_entity){
        $_entity->setUpdateTime(time());
        if(empty($_entity->getCreationTime())){
            $_entity->setCreationTime(time());
        }

        $refClass = new ReflectionClass($this->model);
        $table = $this->getModelTable();
        
        $updateFields = array();
        $identifiers = array_keys($this->getEntityMapping());
        $idFields = array();
        foreach ($refClass->getProperties() as $property) {
            $propertyName = $property->getName();
            $getter = sprintf("get%s", $propertyName);
            if(!in_array($propertyName,$identifiers)) {
                $updateFields[$propertyName] = $_entity->$getter();
            }
            else{
                $idFields[] = "$propertyName = {$_entity->$getter()}";
            }
        }

        $this->db()->update($table)->set($updateFields)->where($idFields)->execute();
    }

    /**
     * @param Entity $_entity
     */
    private function insertEntity($_entity){
        $_entity->setCreationTime(time());
        $_entity->setUpdateTime(time());

        $refClass = new ReflectionClass($this->model);
        $table = $this->getModelTable();

        $insertFields = array();
        $identifiersAnnotations = $this->getEntityMapping();
        foreach ($refClass->getProperties() as $property) {
            $propertyName = $property->getName();
            $getter = sprintf("get%s", $propertyName);
            if(!in_array($propertyName,array_keys($identifiersAnnotations)) || $identifiersAnnotations[$propertyName]->getParameter("type") == "manual") {
                $insertFields[$propertyName] = $_entity->$getter();
            }
        }

        $this->db()->insert($table,$insertFields)->execute();
    }

    public function remove($_entity){
        $table = $this->getModelTable();

        $deleteFields = array();
        $identifiers = array_keys($this->getEntityMapping());
        foreach ($identifiers as $id) {
            $getter = sprintf("get%s", $id);
            $deleteFields[$id] = $_entity->$getter();
        }

        if(count($deleteFields) > 0) {
            $this->db()->delete()->from($table)->where($deleteFields);
        }
    }

    private function getEntityMapping(){
        $reader = new AnnotationReader();
        $props = $reader->getAllPropertiesAnnotations($this->model);

        $identifiers = array();
        /**
         * @type Annotation $annotation
         */
        foreach ($props as $propName => $annotations) {
            foreach ($annotations as $key => $annotation) {
                if($annotation->isAnnotationType("Id")){
                    $identifiers[$propName] = $annotation;
                }
            }
        }

        return $identifiers;
    }
}