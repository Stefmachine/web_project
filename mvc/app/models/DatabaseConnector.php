<?php
class DatabaseConnector
{
    const DB_NAME = "";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const HOST = "localhost";

    private $query;
    private $executeArguments;
    private $fetchMode;
    private $fetchClass;

    function __construct($_fetchMode = PDO::FETCH_ASSOC, $_fetchClass = "")
    {
        if($this->fetchMode == PDO::FETCH_CLASS){
            if($_fetchClass) {
                $this->fetchClass = $_fetchClass;
            }
            else{
                $_fetchMode = PDO::FETCH_ASSOC;
            }
        }
        $this->fetchMode = $_fetchMode;
    }

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

    private function clearQuery(){
        $this->query = "";
        $this->executeArguments = array();
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

    public function where(){
        $this->query .= " WHERE ";
        $conditions = array();
        foreach (func_get_args() as $condition){
            $parts = explode(" ",$condition);
            $name = $parts[0];
            $operator = $parts[1];
            $value = $parts[2];

            $conditions[] = "$name $operator :$name";
            $this->executeArguments[$name] = $value;
        }
        $args = implode(" AND ",$conditions);
        $this->query .= " WHERE $args";
        return $this;
    }

    public function orderBy(){
        $args = implode(",",func_get_args());
        $this->query .= " ORDER BY $args";
        return $this;
    }

    public function insert($_table,$_fields){
        $values = array();
        foreach ($_fields as $name => $newValue){
            $values[] .= "$name = :$name";
            $this->executeArguments[$name] = $newValue;
        }
        $valueString = implode(",",$values);
        $this->query .= " INSERT INTO $_table(".implode(",",array_keys($_fields)).") VALUES($valueString)";
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
        $result = false;
        try {
            $statement = $this->db()->prepare($this->query);
            $this->fetchMode($statement);
            $statement->execute($this->executeArguments);
            $result = $statement->fetch();
        }
        catch (PDOException $PDOException){
            echo "Erreur de base de donnée: ".$PDOException->getMessage();
        }
        catch (Exception $exception){
            echo "Erreur: ".$exception->getMessage();
        }

        $this->clearQuery();

        return $result;
    }

    public function getOne(){
        $result = false;
        try {
            $statement = $this->db()->prepare($this->query);
            $statement->execute($this->executeArguments);
            $result = $statement->fetchColumn();
        }
        catch (PDOException $PDOException){
            echo "Erreur de base de donnée: ".$PDOException->getMessage();
        }
        catch (Exception $exception){
            echo "Erreur: ".$exception->getMessage();
        }

        $this->clearQuery();

        return $result;
    }

    public function getArray(){
        $result = false;
        try {
            $statement = $this->db()->prepare($this->query);
            $this->fetchMode($statement);
            $statement->execute($this->executeArguments);
            $result = $statement->fetchAll();
        }
        catch (PDOException $PDOException){
            echo "Erreur de base de donnée: ".$PDOException->getMessage();
        }
        catch (Exception $exception){
            echo "Erreur: ".$exception->getMessage();
        }

        $this->clearQuery();

        return $result;
    }

    public function execute(){
        try {
            $statement = $this->db()->prepare($this->query);
            $statement->execute($this->executeArguments);
        }
        catch (PDOException $PDOException){
            echo "Erreur de base de donnée: ".$PDOException->getMessage();
        }
        catch (Exception $exception){
            echo "Erreur: ".$exception->getMessage();
        }

        $this->clearQuery();
    }

    /**
     * @param PDOStatement $_statement
     */
    private function fetchMode(&$_statement){
        if($this->fetchMode == PDO::FETCH_CLASS){
            $_statement->setFetchMode($this->fetchMode,$this->fetchClass);
        }
        else{
            $_statement->setFetchMode($this->fetchMode);
        }
    }

    public function createTable($_table,$_columns){

    }

    /*private function columnExists($_tableName,$_columnName){
        if(!empty($_columnName)){
            $query = "SHOW COLUMNS FROM `$_tableName` LIKE '$_columnName'";
            $statement = $this->db()->prepare($query);
            $columnExists = $statement->execute();
            $rowNumber = $columnExists->_numOfRows;
            if($rowNumber > 0){
                return true;
            }
        }
        return false;
    }

    private function compareAndCreateColumns($_tableName,$_columns){
        foreach ($_columns as $columnName => $columnQuery) {
            if (!$this->columnExists($_tableName,$columnName)) {
                $sql=str_replace("PRIMARY","ADD PRIMARY","ALTER TABLE $_tableName ADD $columnQuery");
                db()->execute($sql);
            }
        }
    }

    private function createTableOrCheckColumns($_tableName, $_columns)
    {
        if (!empty($_columns)) {
            $columns = $this->compileColumns($_columns);
            $sql = "CREATE TABLE IF NOT EXISTS $_tableName ($columns) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
            $statement = $this->db()->prepare($sql);
            $statement->execute();
            $this->clearTableQuery();
            $this->compareAndCreateColumns($_tableName, $_columns);
        }
    }

    private function compileColumns($_columns){
        $columnsSQL="";
        $count=count($_columns);
        foreach ($_columns as $key => $column) {
            $columnsSQL.=$column;
            if(--$count > 0){
                $columnsSQL.=", ";
            }
        }
        return $columnsSQL;
    }

    private function clearTableQuery(){
        $this->tableQuery="";
    }*/
}