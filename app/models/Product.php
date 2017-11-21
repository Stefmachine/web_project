<?php

class Product extends Entity
{
    /**
     * @Id
     */
    protected $id;
    private $name;
    private $description;
    private $cost;
	private $picture;
	private $tags;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Entity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return array
     */
    public function getTags()
    {
        return explode(",",$this->tags);
    }

    /**
     * @param array $_tags
     * @return Product
     */
    public function setTags($_tags)
    {
        $this->tags = implode(",",$_tags);
        return $this;
    }

    /**
     * @param string $_tag
     * @return $this
     */
    public function addTag($_tag){
        if(!$this->hasTag($_tag)){
            $this->tags .= ",$_tag";
        }
        return $this;
    }

    /**
     * @param string $_tag
     * @return $this
     */
    public function removeTag($_tag){
        if($this->hasTag($_tag)){
            str_replace($_tag,"",$this->tags);
            $this->tags .= ",$_tag";
        }
        return $this;
    }

    /**
     * @param string $_tag
     * @return bool
     */
    public function hasTag($_tag){
        if(strpos($this->tags,$_tag)){
            return true;
        }
        return false;
    }
}