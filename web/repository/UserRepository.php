<?php
require_once __DIR__."/../model/User.php";
class UserRepository extends User
{
    static function GetByUsernamePassword($_username, $_password){
        $queryString = "SELECT * FROM tbl_user WHERE username = :username AND password = :password";
        $query = self::db()->prepare($queryString);
        $query->execute(array("username" => $_username, "password" => $_password));

        return $query;
    }
}