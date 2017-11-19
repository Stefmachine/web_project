<?php

class Controller
{
    public $APP_DIR;
    public $VIEWS_DIR;
    public $MODELS_DIR;
    public $REPOSITORIES_DIR;
    public $CONTROLLERS_DIR;
    public $TEMPLATES_DIR;

    function __construct()
    {
        $this->APP_DIR = __DIR__ . "/..";
        $this->VIEWS_DIR = __DIR__."/../views";
        $this->MODELS_DIR = __DIR__."/../models";
        $this->REPOSITORIES_DIR = __DIR__."/../repositories";
        $this->CONTROLLERS_DIR = __DIR__."/../controllers";
        $this->TEMPLATES_DIR = __DIR__."/../views/templates";
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

        $viewParts = explode("/",$_view);
        $_data["pageConfigs"] = $this->getViewConfigs($_view);
        foreach ($this->getAllRoutes() as $route) {
            $_data["configs"][$route] = $this->getViewConfigs($route);
        }


        $viewPath = $this->VIEWS_DIR."/$_view.php";
        $templatePath = $this->TEMPLATES_DIR."/{$_data["pageConfigs"]["template"]}.php";
        if(file_exists($viewPath) && file_exists($templatePath)) {
            ob_start();
            include_once $viewPath;
            $content = ob_get_clean();
            include_once $templatePath;

            if(file_exists(__DIR__."/../../public/js/{$viewParts[0]}.{$viewParts[1]}.js")) {
                include_once $this->TEMPLATES_DIR . "/includes/javascript.php";
            }
        }
        else{
            throw new Exception("View ($_view) does not exist.");
        }
    }

    protected function getViewConfigs($_view){
        $reader = new AnnotationReader();
        $viewParts = explode("/",$_view);
        $config = $reader->getPage($this->RouteToController($viewParts[0]),$this->RouteToMethod($viewParts[1]));
        $config["title"] = !empty($config ["title"]) ? $config["title"] : "" ;
        $config["template"] = !empty($config["template"]) ? $config["template"] : "default" ;
		$config["index"] = $_view;

        return $config;
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