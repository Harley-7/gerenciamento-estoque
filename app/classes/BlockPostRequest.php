<?php 

namespace app\classes;

class BlockPostRequest
{

    public static function block()
    {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            return redirect('/error404');
            die();
        }

    }

}

?>