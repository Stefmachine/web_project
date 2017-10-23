<?php
class Database
{
    const DB_NAME = "";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const HOST = "localhost";

    private $query;
    private $executeArguments;

    private function getCNN(){
        $dsn = "mysql:host=".self::HOST.";dbname=".self::DB_NAME;
        $cnn = new PDO($dsn,self::DB_USER,self::DB_PASSWORD);
        $cnn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $cnn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        return $cnn;
    }

    private function db(){
        return $this->getCNN();
    }

    public function select(){
        $args = implode(",",func_get_args());
        $this->query .= "SELECT $args ";
        return $this;
    }

    public function from(){
        $args = implode(",",func_get_args());
        $this->query .= " FROM $args";
        return $this;
    }

    public function where($_conds){
        $this->query .= " WHERE ";
        foreach ($_conds as $name => $newValue){
            $this->query .= "$name = :$name";
            $this->executeArguments[$name] = $newValue;
        }
        $args = implode(" AND ",func_get_args());
        $this->query .= " WHERE $args";
        return $this;
    }

    public function orderBy(){
        $args = implode(",",func_get_args());
        $this->query .= " ORDER BY $args";
        return $this;
    }

    public function insert($_table){
        $this->query .= " INSERT INTO $_table";
        return $this;
    }

    public function update($_table){
        $this->query .= " UPDATE $_table";
        return $this;
    }

    public function set($_fields){
        $this->query .= " SET ";
        foreach ($_fields as $name => $newValue){
            $this->query .= "$name = :$name";
            $this->executeArguments[$name] = $newValue;
        }
        return $this;
    }

    public function getRow(){
        $result = $this->getCNN()->prepare($this->query);
        $result->execute($this->executeArguments);
        return $result->fetch();
    }

    public function getOne(){
        $result = $this->getCNN()->prepare($this->query);
        $result->execute($this->executeArguments);
        return $result->fetchColumn();
    }

    public function getArray(){
        $result = $this->getCNN()->prepare($this->query);
        $result->execute($this->executeArguments);
        return $result->fetchAll();
    }
    //TODO: réunir les fonction de database ici
}