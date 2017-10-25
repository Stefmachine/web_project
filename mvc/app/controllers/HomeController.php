<?php

class HomeController extends Controller
{
    function indexAction()
    {
        $this->view("home/index");
    }

    function errorAction(){
        if(!empty($_SESSION["error"])){
            $error = $_SESSION["error"];
            unset($_SESSION["error"]);
            $this->view("home/error",array("error" => $error));
        }
        else{
            header("location:/public/home/index");
        }
    }
}