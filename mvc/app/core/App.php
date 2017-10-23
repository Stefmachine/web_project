<?php

class App
{
    protected $controller = 'home';
    protected $method = 'index';

    protected $params = array();

    function __construct()
    {
        session_start();
        $url = $this->parseUrl();

        if(file_exists("../app/controllers/$url[0].php")){
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once "../app/controllers/$this->controller.php";
        $this->controller = new $this->controller;

        if(isset($url[1])){
            if(method_exists($this->controller,$url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if($url){
            $this->params = array_values($url);
        }

        call_user_func_array(array($this->controller, $this->method), $this->params);

    }

    public function parseUrl()
    {
        if(!empty($this->XGet("url"))){
            return $url = explode("/",filter_var(rtrim($this->XGet("url"), "/"),FILTER_SANITIZE_URL));
        }
    }

    /**
     * @param string $_key
     * @return string
     */
    function XGet($_key){
        return isset($_GET[$_key]) ? htmlentities($_GET[$_key]) : "" ;
    }

    /**
     * @param string $_key
     * @return string
     */
    function XPost($_key){
        return isset($_POST[$_key]) ? htmlentities($_POST[$_key]) : "" ;
    }

    function XSession($_key){
        return isset($_SESSION[$_key]) ? htmlentities($_SESSION[$_key]) : "" ;
    }

    function removeXSession($_key){
        if(isset($_SESSION[$_key])){
            unset($_SESSION[$_key]);
            return true;
        }
        return false;
    }

    function setXSession($_key,$_value){
        $_SESSION[$_key] = htmlentities($_value);
    }
}