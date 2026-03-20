<?php

use app\database\activerecord\FindBy;
use app\models\Usuario_log;

    function status($status){

        if($status){
            return "<div><span class='online'></span> Online</div>";
        }else{
            return "<div><span class='offline'></span> Offline</div>";
        }

    }

?>