<?php
require_once "Entity.php";

class User extends Entity
{
    protected $id;
    protected $username;
    protected $password;
    protected $firstName;
    protected $lastName;

    function __construct($_id = null)
    {
        $user = array(
            "username" => "",
            "password" => "",
            "firstName" => "",
            "lastName" => ""
        );

        if($_id) {
            $queryString = "SELECT * FROM tbl_user WHERE id = :id";
            $query = $this->db()->prepare($queryString);
            $query->execute(array('id' => $_id));
            if($query){
                $user = $query;
            }
        }

        $this->username = $user["username"];
        $this->password = $user["password"];
        $this->firstName = $user["firstName"];
        $this->lastName = $user["lastName"];
    }

    /**
     * @return int
     */
    function getId(){
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Saves the entity to the database
     */
    public function persist(){
        if($this->id){
            $queryString = "UPDATE tbl_user SET username=:username,password=:password,firstName=:firstName,lastName=:lastName WHERE id=:id";
            $query = $this->db()->prepare($queryString);
            $query->execute(array(
                "id" => $this->id,
                "username" => $this->username,
                "password" => $this->password,
                "firstName" => $this->firstName,
                "lastName" => $this->lastName
            ));
        }
        else{
            $queryString = "INSERT INTO tbl_user(username,password,firstName,lastName) VALUES(:username, :password, :firstName, :lastName)";
            $query = $this->db()->prepare($queryString);
            $query->execute(array(
                "username" => $this->username,
                "password" => $this->password,
                "firstName" => $this->firstName,
                "lastName" => $this->lastName
            ));
        }
    }
}