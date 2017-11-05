<?php

class Product extends Entity
{
    private $id = 0;
    private $name = "";
    private $description = "";
    private $cost = (double)0.00;
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
}