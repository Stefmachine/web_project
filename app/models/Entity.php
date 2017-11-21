<?php

abstract class Entity
{
    protected $creationTime;
    protected $updateTime;
    protected $enabled = 1;

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
}