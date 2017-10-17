<?php
require_once __DIR__."/../repository/UserRepository.php";
class UserController
{
    function login($_username, $_password){
        $user = UserRepository::GetByUsernamePassword($_username,$_password);
        if($user){
            return $user;
        }
        else{
            return false;
        }
    }
}