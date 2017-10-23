<?php

class Controller
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
        $templatePath = __DIR__."/../template/$this->template.php";
        if(file_exists($viewPath) && file_exists($templatePath)) {
            ob_start();
            require_once $viewPath;
            $content = ob_get_clean();
            require_once $templatePath;
        }
    }
}