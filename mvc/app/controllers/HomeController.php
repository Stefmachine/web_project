<?php

class HomeController extends Controller
{
    /**
     * Home page view
     */
    function indexAction()
    {
        $this->view("home/index");
    }

    /**
     * Error page view
     */
    function errorAction(){
        if(!empty($_SESSION["error"])){
            $error = $_SESSION["error"];
            unset($_SESSION["error"]);
            $this->view("home/error",array("error" => $error));
        }
        else{
            throw new Exception("An unexpected error occured.");
        }
    }

    /**
     * Contact page view
     */
    function contactAction(){
        $this->view("home/contact");
    }
}