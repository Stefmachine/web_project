<?php

abstract class Repository
{
    protected $model;

    function __construct()
    {
        $this->model = $this->getRepositoryModel();
    }

    protected function db(){
        return new DatabaseConnector(PDO::FETCH_CLASS,$this->model);
    }

    function find($_id){

        return $this->db()->select("*")->from($this->getModelTable())->where("id = $_id")->getRow();
    }

    function findAll($_limit = 0,$_offset = 0){
        if(!empty($_limit)) {
            return $this->db()->select("*")->from($this->getModelTable())->limit($_limit)->offset($_offset)->getArray();
        }
        else{
            return $this->db()->select("*")->from($this->getModelTable())->getArray();
        }
    }

    function findOneBy($_criteria){
        $conditions = array();
        foreach ($_criteria as $column => $value){
            $conditions[] = "$column = $value";
        }
        return $this->db()->select("*")->from($this->getModelTable())->where($conditions)->getRow();
    }

    function findBy($_criteria){
        $conditions = array();
        foreach ($_criteria as $column => $value){
            $conditions[] = "$column = $value";
        }
        return $this->db()->select("*")->from($this->getModelTable())->where($conditions)->getArray();
    }

    function countAll(){
        return $this->db()->select("COUNT(*)")->from($this->getModelTable())->getOne();
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
        $listOfIds = $this->getEntityMapping();
        foreach ($listOfIds as $name => $id) {
            $getter = sprintf("get%s",ucfirst($name));
            $listOfIds[$name] = $_entity->$getter();
        }

        $result = $this->findOneBy($listOfIds);


        die(var_dump($listOfIds,$result));

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
        $refClass = new ReflectionClass($this->model);
        $table = $this->getModelTable();
        
        $updateFields = array();
        foreach ($refClass->getProperties() as $property) {
            $propertyName = $property->getName();
            $getter = sprintf("get%s", $propertyName);
            if ($propertyName != "id" && !is_array($this->$propertyName)) {
                $updateFields[$propertyName] = $_entity->$getter();
            }
        }
        $id = $_entity->getId();
        $this->db()->update($table)->set($updateFields)->where("id = $id")->execute();
    }

    /**
     * @param Entity $_entity
     */
    private function insertEntity($_entity){
        $refClass = new ReflectionClass($this->model);
        $table = $this->getModelTable();

        $insertFields = array();
        foreach ($refClass->getProperties() as $property) {
            $propertyName = $property->getName();
            $getter = sprintf("get%s", $propertyName);
            if ($propertyName != "id" && !is_array($this->$propertyName)) {
                $insertFields[$propertyName] = $_entity->$getter();
            }
        }
        $this->db()->insert($table,$insertFields)->execute();
    }

    private function getEntityMapping(){
        $reader = new AnnotationReader();
        $props = $reader->getAllPropertiesAnnotations($this->model);

        /**
         * @type Annotation $annotation
         */
        foreach ($props as $propName => $annotations) {
            if(empty($annotations)){
                unset($props[$propName]);
            }
            foreach ($annotations as $key => $annotation) {
                if(!$annotation->isAnnotationType("Id")){
                    unset($props[$propName]);
                }
            }
        }

        return $props;
    }
}