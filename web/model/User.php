<?php
require_once "Entity.php";

class User extends Entity
{
    protected $id;
    protected $username;
    protected $password;
    protected $firstName;
    protected $lastName;

    /**
     * User constructor.
     * @param int|null $_id
     */
    function __construct($_id = null)
    {
        parent::__construct($_id);
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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