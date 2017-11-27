<?php

abstract class Entity
{
    protected $creationTime;
    protected $updateTime;

    /**
     * @return int
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * @param int $creation
     * @return Entity
     */
    public function setCreationTime($creation)
    {
        $this->creationTime = $creation;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @param int $update
     * @return Entity
     */
    public function setUpdateTime($update)
    {
        $this->updateTime = $update;
        return $this;
    }

    function __call($method, $value)
    {
        if(substr($method,0,3) == "set"){
            $property = substr($method,3);

            if(isset($value[0])){
                $this->$property = $value[0];
            }
            else{
                $this->$property = null;
            }
        }
        else if(substr($method,0,3) == "get") {
            $property =substr($method,3);

            return $this->$property;
        }

        throw new BadFunctionCallException("The method ($method) you requested does not exist");
    }
}