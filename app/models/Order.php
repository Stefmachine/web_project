<?php

class Order extends Entity
{
	private $status;

	/**
     * @return string
     */
    public function getStatus($index)
    {
        return $this->status[$index];
    }
}