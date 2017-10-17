<?php
require_once __DIR__."/../repository/UserRepository.php";
class UserController
{
    static function login($_username, $_password){
        $user = UserRepository::GetByUsernamePassword($_username,$_password);
        if($user){
            $_SESSION["connectedUser"] = $user;
            return $user;
        }
        else{
            return false;
        }
    }

    static function logout(){
        if(isset($_SESSION["connectedUser"])){
            unset($_SESSION["connectedUser"]);
            return true;
        }
        return false;
    }
}