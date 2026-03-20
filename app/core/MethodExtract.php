<?php 

namespace app\core;

use app\core\Uri;

class MethodExtract
{

    public static function extract($controller)
    {

        $uri = Uri::uri();
        $method = "index";

        $folder = FolderExtract::extract($uri);

        if(!$folder){
            $method = strtolower(Uri::uriExist($uri, 1));
        }else {
            $method = strtolower(Uri::uriExist($uri, 2));
        }
        
        if($method === ''){
            $method = 'index';
        }
            
        
        if(!method_exists($controller, $method)){
            $method = 'index';
            $sliceIndexStartFrom = (!$folder) ? 1 : 2;
        }else{
            $sliceIndexStartFrom = (!$folder) ? 2 : 3;
        }

        return [
            $method,
            $sliceIndexStartFrom
        ];

    }

}

?>