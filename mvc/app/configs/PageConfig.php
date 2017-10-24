<?php

class PageConfig
{
    private $title;
    private $template;

    function __construct($_assocArray, $_default)
    {
        $refClass = new ReflectionClass(get_class($this));
        $properties = $refClass->getProperties();
        foreach ($properties as $property) {
            $name = $property->getName();
            $this->$name = isset($_assocArray[$name]) ? $_assocArray[$name] : $_default[$name];
        }
    }

    function getTitle(){
        return $this->title;
    }

    function getTemplate(){
        return $this->template;
    }
}