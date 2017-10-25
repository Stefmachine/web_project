<?php

class PageConfig
{
    private $title;
    private $template;
    private $secured;
    private $glyphicon;
    private $pageName;
    private $controllerName;

    function __construct($_assocArray, $_default, $_controller, $_pageName)
    {
        $this->pageName = $_pageName;
        $this->controllerName = $_controller;

        $refClass = new ReflectionClass(get_class($this));
        $properties = $refClass->getProperties();
        foreach ($properties as $property) {
            $name = $property->getName();
            if($name != "pageName" || $name != "controllerName") {
                if (isset($_assocArray[$name])) {
                    $this->$name = $_assocArray[$name];
                } elseif (isset($_default[$name])) {
                    $this->$name = $_default[$name];
                } else {
                    $this->$name = "";
                }
            }
        }
    }

    function getTitle(){
        return $this->title;
    }

    function getTemplate(){
        return $this->template;
    }

    function isSecured(){
        return $this->secured;
    }

    function getPageName(){
        return $this->pageName;
    }

    function getControllerName(){
        return $this->controllerName;
    }

    function getRoute(){
        return "/$this->controllerName/$this->pageName";
    }

    function getGlyphiconClass(){
        if(!empty($this->glyphicon)){
            return "glyphicon glyphicon-{$this->glyphicon}";
        }
        return "";
    }
}