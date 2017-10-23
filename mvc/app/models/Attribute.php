<?php

class Attribute extends Entity
{
    private $name;
    private $description;

    /**
     * Product constructor.
     * @param int|null $_id
     */
    function __construct($_id = null)
    {
        parent::__construct($_id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Attribute
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}