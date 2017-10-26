<?php

class ShopController extends Controller
{
    /**
     * Product list view
     */
    function indexAction(){
        $this->view('shop/index');
    }

    /**
     * Single product view
     *
     * @param int $_id
     */
    function productAction($_id = 1){
        $this->view("shop/product",array("id"=>$_id));
    }
}