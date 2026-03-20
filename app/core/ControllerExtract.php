<?php 

namespace app\core;

class ControllerExtract
{

    public static function extract()
    {

        $uri = Uri::uri();

        $folder = FolderExtract::extract($uri);

        if($folder){
            $controller = Uri::uriExist($uri, 1);   
            $namespace = "app\\controllers\\".$folder."\\";         
        }else {
            $controller = Uri::uriExist($uri, 0);
            $namespace = "app\\controllers\\";
        }


        if(!$controller)
        {
            $controller = CONTROLLER_DEFAULT;
        }

        $namespaceAndController = $namespace.$controller;

        if(class_exists($namespaceAndController)){
            $controller = $namespaceAndController;
        }else{
           $controller = CONTROLLER_PATH.ERROR404;
        }

        return $controller;

    }

}


?>