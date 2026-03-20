<?php

use app\classes\Flash;

function alertMessages($key){

    $flash = Flash::get($key);

    if(isset($flash['message'])){

        return "<script>
                    Swal.fire({
                        title: '{$flash['message']}',
                        icon: '{$flash['icon']}',
                        heightAuto: false
                        });
                </script>";

    }

}

?>