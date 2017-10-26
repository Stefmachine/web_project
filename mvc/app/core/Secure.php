<?php
require_once "AnnotationReader.php";
class Secure extends AnnotationReader
{
    private $headerRedirect;

    function __construct($_securityRedirect)
    {
        $this->headerRedirect = $_securityRedirect;
    }

    function validateSecurity($_class,$_method){
        $isSecured = $this->isSecured($_class,$_method);
        if($isSecured){
            header("location:$this->headerRedirect");
        }
    }

    function isSecured($_class,$_method){
        $annotations = $this->getClassAnnotations($_class);
        $annotations = array_merge($annotations,$this->getMethodAnnotations($_class,$_method));
        $isSecured = false;
        foreach ($annotations as $annotation){
            if($annotation->isAnnotationType("Secured")){
                $isSecured = true;
            }
        }
        return $isSecured;
    }
}