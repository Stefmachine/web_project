<?php

class ShopController extends Controller
{
    function indexAction(){
        $this->view('shop/index');
    }

    function productAction($_id = 1){
        $this->view("shop/product",array("id"=>$_id));
    }
}