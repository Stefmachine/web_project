<?php

class Order extends Entity
{
	private $status;
	private $orderProducts;

	/**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
	
	/**
	 * @param string Status
	 * return Order
	 */
	public function setStatus($status)
    {
		$this->status = $status;
        return $this;
    }
	
	/**
     * @return OrderProduct[]
     */
    public function getOrderProducts()
    {
        return $this->orderProducts;
    }
	
	/**
	 * @param string OrderProduct
	 * return Order
	 */
	public function addOrderProduct($orderProduct)
    {
		$this->orderProducts[] = $orderProduct;
        return $this;
    }
}