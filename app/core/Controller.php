<?php

class Controller
{
    public $APP_DIR;
    public $VIEWS_DIR;
    public $MODELS_DIR;
    public $REPOSITORIES_DIR;
    public $CONTROLLERS_DIR;
    public $TEMPLATES_DIR;

    /**
     * @var PageConfig[] $configs
     */
    private $configs;

    function __construct()
    {
        $this->APP_DIR = __DIR__ . "/..";
        $this->VIEWS_DIR = __DIR__."/../views";
        $this->MODELS_DIR = __DIR__."/../models";
        $this->REPOSITORIES_DIR = __DIR__."/../repositories";
        $this->CONTROLLERS_DIR = __DIR__."/../controllers";
        $this->TEMPLATES_DIR = __DIR__."/../views/templates";

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
        $modelPath = $this->MODELS_DIR."/$_model.php";
        if(!file_exists($modelPath)) {
            throw new Exception("The model $_model does not exist.");
        }
    }

    /**
     * @param string $_model
     * @return Repository
     * @throws Exception
     */
    protected function repository($_model){
        $repositoryName = "{$_model}Repository";
        $repoPath = $this->REPOSITORIES_DIR."/$repositoryName.php";
        if(file_exists($repoPath)) {
            return new $repositoryName;
        }
        else{
            throw new Exception("The repository of $_model does not exist.");
        }
    }

    protected function view($_view, $_data = []){

        function resource($_resource){
            $resourcePath = "public/$_resource";
            return $resourcePath;
        }

        $_data["pageConfigs"] = $this->configs["$_view"];
        $_data["configs"] = $this->configs;
        $viewPath = $this->VIEWS_DIR."/$_view.php";
        $templatePath = $this->TEMPLATES_DIR."/{$_data["pageConfigs"]->getTemplate()}.php";
        if(file_exists($viewPath) && file_exists($templatePath)) {
            ob_start();
            include_once $viewPath;
            $content = ob_get_clean();
            include_once $templatePath;
        }
        else{
            throw new Exception("View ($_view) does not exist.");
        }
    }

    protected function getControllerRoutes($_controller = ''){
        if(empty($_controller)){
            $class = get_class($this);
        }
        else{
            $class = $this->RouteToController($_controller);
        }

        $actions = false;
        $controllerPath = $this->CONTROLLERS_DIR."/$class.php";
        if(file_exists($controllerPath)) {
            if (class_exists($class)) {
                $refClass = new ReflectionClass($class);
                $methods = $refClass->getMethods();
                $actions = preg_grep("/(Action)/", $methods);
            }
        }

        $allRoutes = array();
        foreach ($actions as $route) {
            $parsedAction = $this->MethodToRoute($route->name);
            $parsedController = $this->ControllerToRoute($route->class);
            $allRoutes[] = "$parsedController/$parsedAction";
        }

        return $allRoutes;
    }

    protected function getAllRoutes(){
        $actions = array();
        foreach (glob($this->CONTROLLERS_DIR."/*.php") as $controllerPath){
            $class = basename($controllerPath,".php");
            if(class_exists($class)){
                $refClass = new ReflectionClass($class);
                $methods = $refClass->getMethods();
                $actions = array_merge($actions,preg_grep("/(Action)/",$methods));
            }
        }

        $allRoutes = array();
        foreach ($actions as $route) {
            $parsedAction = $this->MethodToRoute($route->name);
            $parsedController = $this->ControllerToRoute($route->class);
            $allRoutes[] = "$parsedController/$parsedAction";
        }

        return $allRoutes;
    }

    /**
     * @param Exception $exception
     */
    function ExceptionHandler($exception){
        $_SESSION["error"] = $exception;
        GlobalHelper::redirect("home/error");
    }

    /**
     * @param Error $error
     */
    function ErrorHandler($no , $message, $file, $line){
        throw new Exception("#$no - $message in $file on line $line");
    }


    /**
     * @param $_class
     * @return bool|string
     */
    function ControllerToRoute($_class){
        $_class = strtolower($_class);
        return substr($_class,0,strpos($_class,"controller"));
    }

    /**
     * @param $_route
     * @return string
     */
    function RouteToController($_route){
        $_route = ucwords($_route);
        return "{$_route}Controller";
    }

    /**
     * @param $_method
     * @return bool|string
     */
    function MethodToRoute($_method){
        return substr($_method,0,strpos($_method,"Action"));
    }

    /**
     * @param $_route
     * @return string
     */
    function RouteToMethod($_route){
        return "{$_route}Action";
    }
}