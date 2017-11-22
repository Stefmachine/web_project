<?php
class DatabaseConnector
{
    const DB_NAME = "db_ooze";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const HOST = "localhost";

    private $query;
    private $executeArguments;
    private $fetchMode;
    private $fetchClass;

    function __construct($_fetchMode = PDO::FETCH_ASSOC, $_fetchedClass = "")
    {
        if($_fetchMode == PDO::FETCH_CLASS){
            if(empty($_fetchedClass)){
                throw new Exception("Class fetch mode needs a valid class.");
            }
            else{
                $this->fetchClass = $_fetchedClass;
            }
        }
        $this->fetchMode = $_fetchMode;
    }

    private function getCNN(){
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8");
        $dsn = "mysql:host=".self::HOST.";dbname=".self::DB_NAME;
        $cnn = new PDO($dsn,self::DB_USER,self::DB_PASSWORD,$options);
        $cnn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $cnn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        return $cnn;
    }

    private function db(){
        return $this->getCNN();
    }

    private function clearQuery(){
        $this->query = "";
        $this->executeArguments = array();
    }

    public function select(){
        $args = self::tablelize(implode(",",func_get_args()));
        $this->query .= "SELECT $args";
        return $this;
    }

    public function from(){
        $args = self::tablelize(implode(",",func_get_args()));
        $this->query .= " FROM $args";
        return $this;
    }

    public function where(){
        $conditions = array();
        foreach (func_get_args() as $condition){
            if(!is_array($condition)){
                $condition = array($condition);
            }
            foreach ($condition as $subCondition){
                $parts = explode(" ",$subCondition); //fixme: a blank space isn't an intuitive delimiter
                $name = $parts[0];
                $operator = $parts[1];
                $value = $parts[2];
                $column = self::tablelize($name);
                $conditions[] = "$column $operator :$column";
                $this->executeArguments[$column] = $value;
            }
        }
        $args = implode(" AND ",$conditions);
        $this->query .= " WHERE ($args)";
        return $this;
    }

    public function orderBy(){
        $args = array();
        foreach (func_get_args() as $arg){
            if($arg != "ASC" || $arg != "DESC") {
                $args[] = $arg;
            }
            else{
                $args[] = $arg;
            }
        }
        $args = self::tablelize(implode(",",$args));
        $this->query .= " ORDER BY $args";
        return $this;
    }

    public function insert($_table,$_fields){
        $table = self::tablelize($_table);
        $values = array();
        foreach ($_fields as $name => $newValue){
            $column = self::tablelize($name);
            $values[] .= ":$column";
            $this->executeArguments[$column] = $newValue;
        }
        $valueString = self::tablelize(implode(",",$values));
        $fields = self::tablelize(implode(",",array_keys($_fields)));
        $this->query .= " INSERT INTO $table($fields) VALUES($valueString)";
        return $this;
    }

    public function update($_table){
        $table = self::tablelize($_table);
        $this->query .= "UPDATE $table";
        return $this;
    }

    public function set($_fields){
        $this->query .= " SET ";
        $values = array();
        foreach ($_fields as $name => $newValue){
            $column = self::tablelize($name);
            $values[] = "$column = :$column";
            $this->executeArguments[$column] = $newValue;
        }
        $valueString = self::tablelize(implode(",",$values));
        $this->query .= $valueString;
        return $this;
    }

    public function limit($_limit){
        $this->query .= " LIMIT $_limit";
        return $this;
    }

    public function offset($_offset){
        $this->query .= " OFFSET $_offset";
        return $this;
    }

    public function getRow(){
        try{
            $statement = $this->db()->prepare($this->query);
            $this->fetchMode($statement);
            $statement->execute($this->executeArguments);
            $result = $statement->fetch();

            $this->clearQuery();

            return $result;
        }
        catch (PDOException $PDOException){
            throw new Exception($PDOException->getMessage());
        }
    }

    public function getOne(){
        try{
            $statement = $this->db()->prepare($this->query);
            $statement->execute($this->executeArguments);
            $result = $statement->fetchColumn();

            $this->clearQuery();

            return $result;
        }
        catch (PDOException $PDOException){
            throw new Exception($PDOException->getMessage());
        }
    }

    public function getArray(){
        try {
            $statement = $this->db()->prepare($this->query);
            $this->fetchMode($statement);
            $statement->execute($this->executeArguments);
            $result = $statement->fetchAll();

            $this->clearQuery();

            return $result;
        }
        catch (PDOException $PDOException){
            throw new Exception($PDOException->getMessage());
        }
    }

    public function execute(){
        try {
            $statement = $this->db()->prepare($this->query);
            $statement->execute($this->executeArguments);

            $this->clearQuery();
        }
        catch (PDOException $PDOException){
            throw new Exception($PDOException->getMessage());
        }
    }

    /**
     * @param PDOStatement $_statement
     */
    private function fetchMode(&$_statement){
        if($this->fetchMode == PDO::FETCH_CLASS){
            $_statement->setFetchMode($this->fetchMode,$this->fetchClass,array());
        }
        else{
            $_statement->setFetchMode($this->fetchMode);
        }
    }

    public static function tablelize($_word){
        return strtolower(preg_replace('/\B([A-Z])/', '_$1', $_word));
    }
}