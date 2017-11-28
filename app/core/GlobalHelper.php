<?php

/**
 * Created by PhpStorm.
 * User: Stéphane
 * Date: 2017-11-01
 * Time: 13:26
 */
abstract class GlobalHelper
{
    const ROOT = "/web_project/";

    static function redirect($_page = ""){
        $path = self::ROOT."index.php";
        if(!empty($_page)){
            header("location:$path?url=$_page");
        }
        else{
            header("location:$path");
        }
    }

    static function pageLink($_page = ""){
        $path = self::ROOT."index.php";
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

    static function XCookie($_key){
        return isset($_COOKIE[$_key]) ? htmlentities($_COOKIE[$_key]) : "" ;
    }

    static function setXCookie($_key, $_value, $options = array()){
        $defaultOptions = array(
            "expire" => strtotime("+2 days"),
            "path" => "/",
            "domain" => null,
            "secure" => false,
            "httponly" => true
        );
        foreach ($defaultOptions as $option => $default){
            if(empty($options[$option])){
               $options[$option] = $default;
            }
        }
        setcookie($_key,htmlentities($_value),$options["expire"],$options["path"],$options["domain"],$options["secure"],$options["httponly"]);
    }

    static function removeXCookie($_key){
        if(isset($_COOKIE[$_key])) {
            setcookie($_key, "", 1, "/", null, false, true);
            unset($_COOKIE[$_key]);
            return true;
        }
        return false;
    }
}