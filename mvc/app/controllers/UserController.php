<?php

class UserController extends Controller
{
    /**
     * Profile form view
     * @Secured
     */
    function profileAction(){
        $this->view("user/profile");
    }

    /**
     * Login form view
     */
    function loginAction(){
        $this->view("user/login");
    }

    /**
     * Validate login information before connection
     */
    function validateLogin(){
        $username = XPost("username");
        $password = XPost("password");
        var_dump($username,$password);
        die();
    }

    /**
     * @Secured
     */
    function logoutAction(){
        die("user logout");
    }

    /**
     * Cart page view
     * @Secured
     */
    function cartAction(){
        $this->view("user/cart");
    }

    /**
     * Adds product to cart
     * (Ajax?)
     * @Secured
     */
    function addToCart(){

    }

    /**
     * Removes product from cart
     * (Ajax?)
     * @Secured
     */
    function removeFromCart(){

    }
}