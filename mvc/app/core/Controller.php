<?php
require_once "ConvenientFunctions.php";

class Controller extends ConvenientFunctions
{
    private $template = "default";

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
            @set_exception_handler('ErrorHandler'); // MAKE ERROR HANDLING WORK
            echo $somevarthatdoesnotexist;
            ob_start();
            require_once $viewPath;
            $content = ob_get_clean();
            require_once $templatePath;
        }
        else{
            echo "file not found";
        }
    }

    protected function resource($_resource){
        $resourcePath = __DIR__."/../../public/resources/$_resource";
        if(file_exists($resourcePath)) {
            return $resourcePath;
        }
        return false;
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

    function ErrorHandler($exception){
        die("hey");
        $error = $this->XSession("error");
        if(!empty($error)){
            $this->view("/home/error");
        }
        else{
            $this->view("/home/index");
        }
    }
}