<?php

abstract class Entity
{
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    const DB_NAME = "";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const HOST = "localhost";

    private function getCNN(){
        $dsn = "mysql:host=".self::HOST.";dbname=".self::DB_NAME;
        $cnn = new PDO($dsn,self::DB_USER,self::DB_PASSWORD);
        $cnn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $cnn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        return $cnn;
    }

    protected function db(){
        return $this->getCNN();
    }

    function __construct($_id = null)
    {
        if($this->getCallerFunction() === "__construct"){
            //It means this class was instantiated by another class
        }
        $class = get_class($this);
        $refClass = new ReflectionClass($class);
        $table = $this->classToTableName($class);

        $classData = array();
        if($_id) {
            try{
                $queryString = "SELECT * FROM $table WHERE id = :id";
                $query = $this->db()->prepare($queryString);
                $query->execute(array('id' => $_id));
                if($query){
                    $classData = $query;
                }
                else{
                    throw new Exception("This instance of $class does not exist in $table.");
                }
            }
            catch (PDOException $PDOException){
                echo $PDOException->getMessage();
            }
            catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }

        foreach ($refClass->getProperties() as $property) {
            $propName = $property->getName();
            if(!is_array($this->$propName)) {
                $value = isset($classData[$propName]) ? $classData[$propName] : "";
                if ($property->getName() == "id") {
                    $value = isset($classData[$propName]) ? $classData[$propName] : 0;
                }
                $this->$propName = $value;
            }
            else{
                if(!empty($classData["id"])) {
                    $methodName = "populate" . ucwords($propName);
                    try {
                        $this->$methodName;
                    } catch (Exception $exception) {
                        echo $exception->getMessage();
                    }
                }
                else{
                    $this->$propName = array();
                }
            }
        }
    }

    function __call($name, $arguments)
    {
        $currentClass = get_class($this);
        if(strpos($name,"populate") === false){
            throw new Exception("Unknown method $name.");
        }

        $class = substr($name,8);
        if(!class_exists($class)){
            throw new Exception("Class $class doesn't exist.");
        }

        $property = strtolower($class) . "s";
        if(!property_exists($currentClass,$property)){
            throw new Exception("Property $property of class $class doesn't exist.");
        }

        $this->$property = array();
        $table = $this->classToTableName($class,$currentClass);
        if($this->id) {
            $classId = strtolower($class) . "_id";
            $currentClassId = strtolower($currentClass) . "_id";

            try {
                $queryString = "SELECT $classId FROM $table WHERE $currentClassId = :id";
                $query = $this->db()->prepare($queryString);
                $query->execute(array('id' => $this->id));
                if ($query) {
                    foreach ($query as $key => $id) {
                        $this->$property[] = new $class($id);
                    }
                }
            } catch (PDOException $PDOException) {
                echo $PDOException->getMessage();
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }

    private function classToTableName(){
        $arguments = func_get_args();
        $classArray = array();
        foreach ($arguments as $className){
            $classArray[] = strtolower($className);
        }
        sort($classArray);
        $table = "tbl_".implode("_",$classArray);
        return $table;
    }

    /**
     * Saves the entity to the database
     */
    public function persist(){
        try {
            if ($this->id) {
                $this->updateEntity();
            } else {
                $this->insertEntity();
            }
        }
        catch (PDOException $PDOException){
            echo $PDOException->getMessage();
        }
        catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    private function updateEntity(){
        $class = get_class($this);
        $refClass = new ReflectionClass($class);
        $table = $this->classToTableName($class);

        $updateString = "";
        $updateParameters = array();
        foreach ($refClass->getProperties() as $property) {
            $propertyName = $property->getName();
            if (!is_array($this->$propertyName)) {
                if ($propertyName != "id") {
                    $updateString .= "`$propertyName`=:$propertyName";
                }
                $updateParameters[$propertyName] = $this->$propertyName;
            }
        }
        $queryString = "UPDATE $table SET $updateString WHERE id=:id";
        $query = $this->db()->prepare($queryString);
        $query->execute($updateParameters);
    }

    private function insertEntity(){
        $class = get_class($this);
        $refClass = new ReflectionClass($class);
        $table = $this->classToTableName($class);

        $insertStrings = array(
            "columns" => "",
            "values" => ""
        );
        $insertParameters = array();
        $count = 0;
        foreach ($refClass->getProperties() as $property) {
            $propertyName = $property->getName();
            if ($propertyName != "id" && !is_array($this->$propertyName)) {
                if ($count != 0) {
                    $insertStrings["columns"] .= ",";
                    $insertStrings["values"] .= ",";
                }
                $insertStrings["columns"] .= "`$propertyName`";
                $insertStrings["values"] .= ":$propertyName";
                $insertParameters[$propertyName] = $this->$propertyName;
                $count++;
            }
        }

        $queryString = "INSERT INTO $table({$insertStrings["columns"]}) VALUES({$insertStrings["values"]})";
        $query = $this->db()->prepare($queryString);
        $query->execute($insertParameters);
    }

    private function getCallerFunction(){ //TODO: Put it somewhere convenient
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        if(isset($backtrace[2])){
            return $backtrace[2]["function"];
        }
        return false;
    }
}