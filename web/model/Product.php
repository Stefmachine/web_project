<?php
require_once "Attribute.php";
class Product extends Entity
{
    private $id;
    private $name;
    private $description;
    private $cost;
    private $attributes;

    /**
     * Product constructor.
     * @param int|null $_id
     */
    function __construct($_id = null)
    {
        parent::__construct($_id);
        $this->populateAttributes();
    }

    private function populateAttributes(){ //TODO: create some magic function for array population
        $this->attributes = array();
        if($this->id) {
            $queryString = "SELECT attribute_id FROM tbl_product_attributes WHERE product_id = :id";
            $query = $this->db()->prepare($queryString);
            $query->execute(array('id' => $this->id));
            if ($query) {
                foreach ($query as $key => $a_id) {
                    $this->attributes[] = new Attribute($a_id);
                }
            }
        }
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
    public function setCost($cost)
    {
        $this->cost = $cost;
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