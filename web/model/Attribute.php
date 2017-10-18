<?php

class Attribute extends Entity
{
    private $id;
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

    /**
     * Saves the entity to the database
     */
    public function persist(){
        if($this->id){
            $queryString = "UPDATE tbl_attribute SET `name`=:name,description=:description WHERE id=:id";
            $query = $this->db()->prepare($queryString);
            $query->execute(array(
                "id" => $this->id,
                "name" => $this->name,
                "description" => $this->description
            ));
        }
        else{
            $queryString = "INSERT INTO tbl_attribute(`name`,description) VALUES(:name, :description)";
            $query = $this->db()->prepare($queryString);
            $query->execute(array(
                "name" => $this->name,
                "description" => $this->description
            ));
        }
    }
}