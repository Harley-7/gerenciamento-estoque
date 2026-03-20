<?php 

namespace app\classes;

use app\interfaces\ControllerInterface;

class BlockSomeReason
{

    public static function block(ControllerInterface $controllerInterface, Array $blockMethods)
    {

        $canBlockMethod = Block::getMethodToBlock($controllerInterface, $blockMethods);

        if($canBlockMethod)
        {

            BlockPostRequest::block();

            return redirect('/');
            
        }

    }

}


?>