<?php
require_once "ConvenientFunctions.php";
require_once __DIR__."/../configs/PageConfig.php";

class Controller
{
    private $template = "default";
    private $configs;

    function __construct()
    {
        $pageConfigs = json_decode(file_get_contents(__DIR__."/../configs/pagesConfigs.json"),true);
        foreach ($pageConfigs as $key => $config){
            if($key != "default") {
                foreach ($config as $pageName => $page){
                    $this->configs[$key."_".$pageName] = new PageConfig($page,$pageConfigs["default"]);
                }
            }
        }
        die(var_dump($this->configs));
        @set_exception_handler(array($this,'ExceptionHandler'));
        @set_error_handler(array($this,'ErrorHandler'));
    }

    protected function model($_model){
        $modelPath = __DIR__."/../models/$_model.php";
        if(file_exists($modelPath)) {
            require_once $modelPath;
        }
    }

    protected function view($_view, $_data = []){
        $viewPath = __DIR__."/../views/$_view.php";
        $templatePath = __DIR__."/../views/templates/$this->template.php";
        if(file_exists($viewPath) && file_exists($templatePath)) {
            $title = "";
            ob_start();
            require_once $viewPath;
            $content = ob_get_clean();
            require_once $templatePath;
        }
        else{
            echo "file not found";
        }
    }

    protected function templateInclude($_file){
        $includeFile = __DIR__."/../views/templates/includes/$_file.php";
        if(file_exists($includeFile)) {
            require_once $includeFile;
        }
        return false;
    }

    protected function getRoute($_route, $_controller = ''){
        if(empty($_controller)){
            $_controller = get_class($this);
        }

        $parsedRoute = false;
        if(class_exists($_controller)) {
            if (method_exists($_controller."Controller", $_route . "Action")) {
                $parsedRoute = "/public/$_controller/$_route";
            }
        }

        return $parsedRoute;
    }

    protected function getControllerRoutes($_controller = ''){
        if(empty($_controller)){
            $_controller = get_class($this);
        }
        $controller = $_controller."Controller";
        $actions = false;
        if(class_exists($controller)) {
            require_once __DIR__ . "/../controllers/$controller.php";
            $refClass = new ReflectionClass($controller);
            $methods = $refClass->getMethods();
            $actions = preg_grep("/(Action)/", $methods);
        }

        return $actions;
    }

    protected function getAllRoutes(){
        $actions = array();
        foreach (glob(__DIR__."/../controllers/*.php") as $controller){
            require_once $controller;
            $class = basename($controller,".php");
            if(class_exists($class)){
                $refClass = new ReflectionClass($class);
                $methods = $refClass->getMethods();
                $actions = array_merge($actions,preg_grep("/(Action)/",$methods));
            }
        }

        $allRoutes = array();
        foreach ($actions as $route) {
            $parsedAction = substr($route->name, 0, strpos($route->name,"Action"));
            $parsedController = substr($route->class, 0, strpos($route->class,"Controller"));
            $allRoutes[] = "/public/$parsedController/$parsedAction";
        }

        return $allRoutes;
    }

    /**
     * @param Exception $exception
     */
    function ExceptionHandler($exception){
        $this->view("/home/error",$exception);
        die();
    }

    /**
     * @param Error $error
     */
    function ErrorHandler($no , $message, $file, $line){
        throw new Exception("Error #$no: $message in $file on line $line");
    }


}