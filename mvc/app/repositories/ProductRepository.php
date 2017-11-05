<?php

class ProductRepository extends Repository
{
    function find($_id)
    {
        $product = parent::find($_id);
        return $product;
    }
}