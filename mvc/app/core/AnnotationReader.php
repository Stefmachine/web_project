<?php
require_once "Annotation.php";

class AnnotationReader
{
    /**
     * @param string $_class
     * @return Annotation[]
     */
    public function getClassAnnotations($_class){
        $refClass = new ReflectionClass($_class);
        $classComments = $refClass->getDocComment();
        $classAnnotations = array();
        if(!empty($classComments)) {
            $classAnnotations = $this->findAnnotations($classComments);
        }
        return $classAnnotations;
    }

    /**
     * @param string $_class
     * @param string $_method
     * @return Annotation[]
     */
    public function getMethodAnnotations($_class, $_method){
        $refClass = new ReflectionClass($_class);
        $methodComments = $refClass->getMethod($_method)->getDocComment();
        $methodAnnotations = array();
        if(!empty($methodComments)) {
            $methodAnnotations = $this->findAnnotations($methodComments);
        }
        return $methodAnnotations;
    }

    /**
     * @param string $_comments
     * @return Annotation[]
     */
    private function findAnnotations($_comments){
        $commentsArray = $this->sanitizeComment($_comments);
        $annotations = array_values(preg_grep("/@/",$commentsArray));

        $parsedAnnotations = array();
        foreach ($annotations as $annotation) {
            $length = strpos($annotation,"(");
            if($length) {
                $annotationName = substr($annotation, 1, $length - 1);
            }
            else{
                $annotationName = substr($annotation, 1);
            }
            $parameters = $this->getAnnotationParameters($annotation);
            $parsedAnnotations[] = new Annotation($annotationName,$parameters);
        }
        return $parsedAnnotations;
    }

    /**
     * @param string $_comments
     * @return array
     */
    private function sanitizeComment($_comments){
        $comments = $_comments;
        foreach (array("/**","*/"," ","\n","\r") as $string){
            $comments = str_replace($string,"",$comments);
        }
        $comments = array_filter(explode("*",$comments));
        return $comments;
    }

    /**
     * @param string $_annotation
     * @return array
     */
    private function getAnnotationParameters($_annotation){
        $paramsStart = strpos($_annotation,"(") + 1;
        $paramsEnd = strpos($_annotation,")");
        $length = $paramsEnd - $paramsStart;
        $params = explode(",",substr($_annotation,$paramsStart,$length));

        $parsedParams = array();
        foreach ($params as $key => $param) {
            $p = explode("=",$param);
            if(isset($p[0]) && isset($p[1])) {
                $parsedParams[$p[0]] = $p[1];
            }
        }
        return $parsedParams;
    }
}