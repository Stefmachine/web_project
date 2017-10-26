<?php
require_once "ConvenientFunctions.php";
require_once __DIR__."/../configs/PageConfig.php";

class Controller
{
    /**
     * @var PageConfig[] $configs
     */
    private $configs;

    function __construct()
    {
        $pageConfigs = json_decode(file_get_contents(__DIR__."/../configs/pagesConfigs.json"),true);
        foreach ($pageConfigs as $controller => $config){
            if($controller != "default") {
                foreach ($config as $pageName => $page){
                    $this->configs[$controller."/".$pageName] = new PageConfig($page,$pageConfigs["default"],$controller, $pageName);
                }
            }
        }
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
        $_data["pageConfigs"] = $this->configs["$_view"];
        $_data["configs"] = $this->configs;
        $viewPath = __DIR__."/../views/$_view.php";
        $templatePath = __DIR__."/../views/templates/{$_data["pageConfigs"]->getTemplate()}.php";
        if(file_exists($viewPath) && file_exists($templatePath)) {
            ob_start();
            require_once $viewPath;
            $content = ob_get_clean();
            require_once $templatePath;
        }
        else{
            throw new Exception("View ($_view) does not exist.");
        }
    }

    protected function templateInclude($_file){
        $includeFile = __DIR__."/../views/templates/includes/$_file.php";
        if(file_exists($includeFile)) {
            require_once $includeFile;
        }
        return false;
    }

    protected function getLink($_route){
        $parsedRoute = "/public/$_route";

        return $parsedRoute;
    }

    protected function getControllerRoutes($_controller = ''){
        if(empty($_controller)){
            $class = get_class($this);
        }
        else{
            $class = RouteToClass($_controller);
        }

        $actions = false;
        $controllerPath = __DIR__ . "/../controllers/$class.php";
        if(file_exists($controllerPath)) {
            require_once $controllerPath;
            if (class_exists($class)) {
                $refClass = new ReflectionClass($class);
                $methods = $refClass->getMethods();
                $actions = preg_grep("/(Action)/", $methods);
            }
        }

        $allRoutes = array();
        foreach ($actions as $route) {
            $parsedAction = MethodToRoute($route->name);
            $parsedController = ClassToRoute($route->class);
            $allRoutes[] = "$parsedController/$parsedAction";
        }

        return $allRoutes;
    }

    protected function getAllRoutes(){
        $actions = array();
        foreach (glob(__DIR__."/../controllers/*.php") as $controllerPath){
            require_once $controllerPath;
            $class = basename($controllerPath,".php");
            if(class_exists($class)){
                $refClass = new ReflectionClass($class);
                $methods = $refClass->getMethods();
                $actions = array_merge($actions,preg_grep("/(Action)/",$methods));
            }
        }

        $allRoutes = array();
        foreach ($actions as $route) {
            $parsedAction = MethodToRoute($route->name);
            $parsedController = ClassToRoute($route->class);
            $allRoutes[] = "$parsedController/$parsedAction";
        }

        return $allRoutes;
    }

    /**
     * @param Exception $exception
     */
    function ExceptionHandler($exception){
        $_SESSION["error"] = $exception;
        header("location:/public/home/error");
    }

    /**
     * @param Error $error
     */
    function ErrorHandler($no , $message, $file, $line){
        throw new Exception("#$no - $message in $file on line $line");
    }


}