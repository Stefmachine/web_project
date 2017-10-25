<?php

class UserController extends Controller
{
    function profileAction(){
        $this->view("user/profile");
    }

    function loginAction(){
        $this->view("user/login");
    }

    function validateLogin(){
        $username = XPost("username");
        $password = XPost("password");
        var_dump($username,$password);
        die();
    }

    function logoutAction(){
        die("user logout");
    }

    function cartAction(){
        $this->view("user/cart");
    }
}