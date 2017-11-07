<?php

class Annotation
{
    private $name;
    private $parameters;

    function __construct($_name, $_parameters = array())
    {
        $this->name = $_name;
        $this->parameters = $_parameters;
    }

    public function isAnnotationType($_type){
        return strtolower($this->name) == strtolower($_type);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}