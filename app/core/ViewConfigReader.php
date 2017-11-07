<?php

class ViewConfigReader extends AnnotationReader
{
    public function getTemplate($_view){
        $controllerAndMethod = explode("/",$_view);

        $template = "default";
        $annotations = $this->getMethodAnnotations($controllerAndMethod[0],$controllerAndMethod[1]);
        foreach ($annotations as $annotation){
            if($annotation->isAnnotationType("Template")){
                $template = $annotation->getParameters("name");
            }
        }

        return $template;
    }

    public function getTitle($_view){
        $controllerAndMethod = explode("/",$_view);

        $title = "";
        $annotations = $this->getMethodAnnotations($controllerAndMethod[0],$controllerAndMethod[1]);
        foreach ($annotations as $annotation){
            if($annotation->isAnnotationType("Title")){
                $title = $annotation->getParameters("name");
            }
        }

        return $title;
    }
}