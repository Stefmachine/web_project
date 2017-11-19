<?php

abstract class Entity
{
    protected $id;
    protected $creation;
    protected $update;
    protected $enabled = 1;

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
     * @return int
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * @param int $creation
     * @return Entity
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @param int $update
     * @return Entity
     */
    public function setUpdate($update)
    {
        $this->update = $update;
        return $this;
    }
}