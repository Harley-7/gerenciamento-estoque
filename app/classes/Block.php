<?php 

namespace app\classes;

use app\core\MethodExtract;
use app\interfaces\ApiInterface;
use app\interfaces\ControllerInterface;

class Block
{

    public static function getMethodToBlock(ControllerInterface|ApiInterface $controllerInterface, Array $blockMethods)
    {

        $methods = get_class_methods($controllerInterface);
        
        [$actualMethod] = MethodExtract::extract($controllerInterface);
        
        $blockMethod = false;

        foreach($methods as $method)
        {
            if(in_array($method, $blockMethods) && strtolower($method) === $actualMethod){
                $blockMethod = true;
            }
        }
        
        return $blockMethod;

    }

}


?>