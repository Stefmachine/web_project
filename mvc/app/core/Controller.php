<?php
require_once "ConvenientFunctions.php";
require_once __DIR__."/../configs/PageConfig.php";

class Controller
{
    const APP_DIR = __DIR__ . "/..";
    const VIEWS_DIR = __DIR__."/../views";
    const MODELS_DIR = __DIR__."/../models";
    const REPOSITORIES_DIR = __DIR__."/../repositories";
    const CONTROLLERS_DIR = __DIR__."/../controllers";
    const TEMPLATES_DIR = __DIR__."/../views/templates";

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
        $modelPath = $this::MODELS_DIR."/$_model.php";
        if(file_exists($modelPath)) {
            require_once $modelPath;
        }
        else{
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
        $repoPath = $this::REPOSITORIES_DIR."/$repositoryName.php";
        if(file_exists($repoPath)) {
            require_once $repoPath;
            return new $repositoryName;
        }
        else{
            throw new Exception("The repository of $_model does not exist.");
        }
    }

    protected function view($_view, $_data = []){
        $_data["pageConfigs"] = $this->configs["$_view"];
        $_data["configs"] = $this->configs;
        $viewPath = $this::VIEWS_DIR."/$_view.php";
        $templatePath = $this::TEMPLATES_DIR."/{$_data["pageConfigs"]->getTemplate()}.php";
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
        $includeFile = $this::TEMPLATES_DIR."/includes/$_file.php";
        if(file_exists($includeFile)) {
            require_once $includeFile;
        }
        return false;
    }

    protected function getControllerRoutes($_controller = ''){
        if(empty($_controller)){
            $class = get_class($this);
        }
        else{
            $class = RouteToController($_controller);
        }

        $actions = false;
        $controllerPath = $this::CONTROLLERS_DIR."/$class.php";
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
            $parsedController = ControllerToRoute($route->class);
            $allRoutes[] = "$parsedController/$parsedAction";
        }

        return $allRoutes;
    }

    protected function getAllRoutes(){
        $actions = array();
        foreach (glob($this::CONTROLLERS_DIR."/*.php") as $controllerPath){
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
            $parsedController = ControllerToRoute($route->class);
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


}