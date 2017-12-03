<?php

class OrderRepository extends Repository
{
    function findBy($_criteria)
    {
        $conditions = array();
        foreach ($_criteria as $column => $value){
            $conditions[] = "$column = $value";
        }
        $orders =  $this->db()->select($this->modelProperties)->from($this->getModelTable())->where($conditions)->orderBy("completed_time DESC")->getArray();

        foreach ($orders as $key => $order) {
            if($order->getState() == "pending"){
                unset($orders[$key]);
                array_unshift($orders,$order);
            }
        }

        return $orders;
    }
}