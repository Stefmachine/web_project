<?php
require_once "Attribute.php";
class Product extends Entity
{
    private $id;
    private $name;
    private $description;
    private $cost;
    private $attributes = array();

    /**
     * Product constructor.
     * @param int|null $_id
     */
    function __construct($_id = null)
    {
        parent::__construct($_id);
    }

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
     * @return Attribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
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

    /**
     * Saves the entity to the database
     */
    public function persist(){
        if($this->id){
            $queryString = "UPDATE tbl_product SET `name`=:name,description=:description,cost=:cost WHERE id=:id";
            $query = $this->db()->prepare($queryString);
            $query->execute(array(
                "id" => $this->id,
                "name" => $this->name,
                "description" => $this->description,
                "cost" => $this->cost
            ));
        }
        else{
            $queryString = "INSERT INTO tbl_product(`name`,description,cost) VALUES(:name, :description, :cost)";
            $query = $this->db()->prepare($queryString);
            $query->execute(array(
                "name" => $this->name,
                "description" => $this->description,
                "cost" => $this->cost
            ));
        }
    }
}