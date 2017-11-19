<?php

class order extends Entity
{
	private $id;
	private $products   = array();
	private $quantities = array();
	private $formats    = array();
	private $status     = array();
	
	/* Date & time */
	private $created;
	private $updated;

    /**
     * @return float
     */
    public function getID()
    {
        return $this->id;
    }
	
	/**
     * @return float
     */
    public function getProduct($index)
    {
        return $this->products[$index];
    }
	
	/**
     * @return float array
     */
    public function getAllProduct()
    {
        return $this->products;
    }
	
	/**
     * @return float
     */
    public function getProductQuantity($index)
    {
        return $this->quantities[$index];
    }
	
	/**
     * @return float array
     */
    public function getAllProductQuantity()
    {
        return $this->quantities;
    }
	
	/**
     * @return string
     */
    public function getFormat($index)
    {
        return $this->formats[$index];
    }
	
	/**
     * @return string array
     */
    public function getAllFormats()
    {
        return $this->formats;
    }
	
	/**
     * @return string
     */
    public function getStatus($index)
    {
        return $this->status[$index];
    }
	
	/**
     * @return string array
     */
    public function getAllStatus()
    {
        return $this->status;
    }
	
	/**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }
	
	/**
     * @return string
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}