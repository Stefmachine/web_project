<?php

function resource($_resource){
    $resourcePath = "resources/$_resource";
    return $resourcePath;
}

function ControllerToRoute($_class){
    $_class = strtolower($_class);
    return substr($_class,0,strpos($_class,"controller"));
}

function RouteToController($_route){
    $_route = ucwords($_route);
    return "{$_route}Controller";
}

function MethodToRoute($_method){
    return substr($_method,0,strpos($_method,"Action"));
}

function RouteToMethod($_route){
    return "{$_route}Action";
}