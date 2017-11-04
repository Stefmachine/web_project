<?php

/**
 * Created by PhpStorm.
 * User: Stéphane
 * Date: 2017-11-01
 * Time: 13:26
 */
abstract class GlobalHelper
{
    const ROOT = "/web_project/mvc/";

    static function redirect($_page = ""){
        $path = self::ROOT."public/index.php";
        if(!empty($_page)){
            header("location:$path?url=$_page");
        }
        else{
            header("location:$path");
        }
    }

    static function pageLink($_page = ""){
        $path = self::ROOT."public/index.php";
        if(!empty($_page)) {
            return "$path?url=$_page";
        }
        else{
            return $path;
        }
    }

    /**
     * @param string $_key
     * @return string
     */
    static function XGet($_key){
        return isset($_GET[$_key]) ? htmlentities($_GET[$_key]) : "" ;
    }

    /**
     * @param string $_key
     * @return string
     */
    static function XPost($_key){
        return isset($_POST[$_key]) ? htmlentities($_POST[$_key]) : "" ;
    }

    static function XSession($_key){
        return isset($_SESSION[$_key]) ? htmlentities($_SESSION[$_key]) : "" ;
    }

    static function removeXSession($_key){
        if(isset($_SESSION[$_key])){
            unset($_SESSION[$_key]);
            return true;
        }
        return false;
    }

    static function setXSession($_key,$_value){
        $_SESSION[$_key] = htmlentities($_value);
    }
}