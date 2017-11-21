<?php

class Order extends Entity
{
    /**
     * @Id
     */
    protected $id;
	private $status;
	private $completedTime;
	private $userId;

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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getCompletedTime()
    {
        return $this->completedTime;
    }

    /**
     * @param int $completedDate
     * @return Order
     */
    public function setCompletedTime($completed)
    {
        $this->completedTime = $completed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return Order
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }


}