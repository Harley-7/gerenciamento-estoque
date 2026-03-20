<?php

use app\classes\Flash;

function flash($key)
{

    $flash = Flash::get($key);

    if(isset($flash['message']))
    {

        return 
        
        "<div class='alert alert-{$flash['alert']}' role='alert'>
            {$flash['message']}
        </div>";

    }

}

?>