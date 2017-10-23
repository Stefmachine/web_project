<?php
require_once __DIR__."/../model/User.php";
class UserRepository extends User
{
    static function GetByUsernamePassword($_username, $_password){
        $result = self::db()->select("*")->from("tbl_user")->where("username = $_username","password = $_password")->toObject("User");
        return $result;
    }

    static function GetById($_id){
        $result = self::db()->select("*")->from("tbl_user")->where("id = $_id")->toObject("User");
    }
}