<?php

use app\classes\Old;

    function old($key)
    {

        $old = Old::get($key);

        if(isset($old)){
            return $old;
        }

    }

?>