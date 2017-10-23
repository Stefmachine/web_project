<?php

class Home extends Controller
{
    function index($_name = '')
    {
        $this->model('User');
        $user = new User();
        $user->name = $_name;
        echo $user->name;

        $this->view("home/index",array('name' => $user->name));
    }

    function test($_mot = ''){
        echo $_mot;
        echo 'home/test';
    }
}