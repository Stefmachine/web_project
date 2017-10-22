<?php
function getIncludeFile($_fileName){
    include __DIR__."/../views/templates/includes/$_fileName.php";
}

/**
 * @return array
 */
function getAllLinks(){
    $list = array(
        "home" => array("file" => "home.php", "title" => "Accueil"),
        "shop" => array("file" => "shop.php", "title" => "Catalogue"),
        "contact_us" => array("file" => "contact_us.php", "title" => "Nous joindre"),
        "login" => array("file" => "login.php", "title" => "Connexion"),
        "profile" => array("file" => "", "needConnection" => true, "title" => "Profile"),
        "cart" => array("file" => "", "needConnection" => true, "title" => "Panier"),
        "error" => array("file" => "error.php", "title" => "Erreur"),
        "logout" => array("file" => "index.php", "title" => "Se déconnecter", "needConnection" => true)
    );
    return $list;
}

/**
 * @param string $_page
 * @return array
 * @throws Exception
 */
function getFile($_page){

    $navigation = getAllLinks();

    if(!isset($navigation[$_page])){
        throw new Exception("La page recherchée ($_page) n'existe pas.");
    }

    return $navigation[$_page]["file"];
}

function getPageTitle($_page){
    $navigation = getAllLinks();

    if(!isset($navigation[$_page])){
        throw new Exception("La page recherchée ($_page) n'existe pas.");
    }

    return (isset($navigation[$_page]["title"]) ? $navigation[$_page]["title"] : "Page inconnue");
}

/**
 * @param string $_page
 * @return bool
 */
function pageNeedsConnection($_page){
    $links = getAllLinks();
    if(isset($links[$_page])){
        if(isset($links[$_page]["needConnection"])){
            return $links[$_page]["needConnection"];
        }
    }
    return false;
}

/**
 * @param string $_link
 * @param string $_template
 */
function buildPage($_link, $_template = "default.php"){
    $page = __DIR__."/../views/pages/$_link";
    $template = __DIR__."/../views/templates/$_template";

    include $page;
    include $template;
}