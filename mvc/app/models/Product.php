<?php
require_once "Entity.php";
require_once "Attribute.php";
class Product extends Entity
{
    private $id = 0;
    private $name = "";
    private $description = "";
    private $cost = (double)0.00;
    private $attributes = array();
	private $picture = "";

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return Product
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
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return Product
     */
    public function setCost($_cost)
    {
        $this->cost = $_cost;
        return $this;
    }

	/**
     * @return string
     */
	 public function getPicture()
	 {
		 return $this->picture;
	 }
	 
	 /**
	  * @param string $picture
	  * @return Product
	  */
	 public function setPicture($_picture)
	 {
		 $this->picture = $_picture;
		 return $this;
	 }
	
    /**
     * @return Attribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param $_attribute
     * @return $this
     */
    public function addAttribute($_attribute){
        $this->attributes[] = $_attribute;
        return $this;
    }

    /**
     * @param Attribute[] $_attributes
     * @return Product
     */
    public function setAttributes($_attributes)
    {
        $this->attributes = $_attributes;
        return $this;
    }
}