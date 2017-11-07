<?php

class Secure extends AnnotationReader //todo: Create autofunction in annotation reader class?
{
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