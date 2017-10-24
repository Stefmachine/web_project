<?php

class HomeController extends Controller
{
    function indexAction()
    {
        $this->view("home/index");
    }
}