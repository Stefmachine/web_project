<?php

abstract class Entity
{
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
        $class = get_class($this);
        $refClass = new ReflectionClass($class);
        $table = "tbl_".strtolower($class);

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

            $value = isset($classData[$propName]) ? $classData[$propName] : "";
            if($property->getName() == "id"){
                $value = isset($classData[$propName]) ? $classData[$propName] : 0;
            }
            $this->$propName = $value;
        }
    }

    /**
     * Saves the entity to the database
     */
    public function persist(){
        try {
            if ($this->id) {
                $this->update();
            } else {
                $this->insert();
            }
        }
        catch (PDOException $PDOException){
            echo $PDOException->getMessage();
        }
        catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    private function update(){
        $class = get_class($this);
        $refClass = new ReflectionClass($class);
        $table = "tbl_" . strtolower($class);

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

    private function insert(){
        $class = get_class($this);
        $refClass = new ReflectionClass($class);
        $table = "tbl_" . strtolower($class);

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
}