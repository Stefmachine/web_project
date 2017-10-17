<?php
function getIncludeFile($_fileName){
    include __DIR__."/../views/templates/includes/$_fileName.php";
}

/**
 * @return array
 */
function getAllLinks(){
    $list = array(
        "home" => "home.php",
        "shop" => "",
        "contact_us" => "",
        "login" => "",
        "disconnect" => "",
        "profile" => "",
        "cart" => ""
    );
    return $list;
}

/**
 * @param string $_key
 * @return array
 * @throws Exception
 */
function getLink($_key){

    $navigation = getAllLinks();

    if(!isset($navigation[$_key])){
        throw new Exception("The item you requested ($_key) is not defined.");
    }

    return $navigation[$_key];
}

function buildPage($_link, $_template = "default.php"){
    $page = __DIR__."/../views/pages/$_link";
    $template = __DIR__."/../views/templates/$_template";

    include $page;
    include $template;
}