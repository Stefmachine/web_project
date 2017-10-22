<?php
abstract class Database
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

    //TODO: réunir les fonction de database ici
}