<?php

class ProductRepository extends Repository
{
    function findAllByTag($_limit = 25, $_offset = 0,$_tag = "")
    {
        /**
         * @type Product[] $products
         */
        $products = $this->db()->select($this->modelProperties)->from($this->getModelTable())->where("tags LIKE %$_tag%")->limit($_limit)->offset($_offset)->getArray();

        return $products;
    }

    function countAllByTag($_tag = "")
    {
        return $this->db()->select("count(*)")->from($this->getModelTable())->where("tags LIKE %$_tag%")->getOne();
    }
}