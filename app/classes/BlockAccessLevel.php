<?php 

namespace app\classes;

use app\interfaces\ApiInterface;
use app\interfaces\ControllerInterface;

class BlockAccessLevel
{

    public static function block(ControllerInterface|ApiInterface $controllerInterface, Array $blockMethods, Array $access_levels)
    {

        $canBlockMethod = Block::getMethodToBlock($controllerInterface, $blockMethods);

        if(!isset($_SESSION['user']))
        {

            BlockPostRequest::block();

            return redirect('/login');

        }

        if(!in_array($_SESSION['user']->access_level, $access_levels) && $canBlockMethod){

            BlockPostRequest::block();

            return redirect('/'.$_SESSION['user']->access_level);

        }

    }

}


?>