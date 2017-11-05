<?php

class Request
{
    public $get;
    public $post;
    public $session;
    public $cookie;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->session = $_SESSION;
        $this->cookie = $_COOKIE;
    }

    public function xssSecure(){

    }
}