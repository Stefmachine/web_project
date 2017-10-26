<?php
require_once "ConvenientFunctions.php";
require_once "Secure.php";

class App
{
    protected $controller = 'HomeController';
    protected $method = 'indexAction';

    protected $params = array();

    function __construct()
    {
        session_start();
        $url = $this->parseUrl();

        if(isset($url[0])) {
            $controllerName = $url[0] . "Controller";
            if (file_exists("../app/controllers/$controllerName.php")) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        require_once "../app/controllers/$this->controller.php";
        $this->controller = new $this->controller;

        if(isset($url[1])){
            $method = $url[1]."Action";
            if(method_exists($this->controller,$method)){
                $this->method = $method;
                unset($url[1]);
            }
            elseif (method_exists($this->controller,$url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if(1) { //todo:user is not connected
            $security = new Secure("/public/user/login");
            $security->validateSecurity($this->controller, $this->method);
        }

        if($url){
            $this->params = array_values($url);
        }

        call_user_func_array(array($this->controller, $this->method), $this->params);

    }

    public function parseUrl()
    {
        if(!empty(XGet("url"))){
            return $url = explode("/",filter_var(rtrim(XGet("url"), "/"),FILTER_SANITIZE_URL));
        }
    }
}