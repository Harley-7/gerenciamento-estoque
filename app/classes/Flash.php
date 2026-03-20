<?php 

namespace app\classes;

class Flash
{

    public static function set($key, $message, $alert = 'danger', $icon = 'error')
    {

        if(!isset($_SESSION['messages'][$key]))
        {

            $_SESSION['messages'][$key] = [
                'message' => $message,
                'alert' => $alert,
                'icon' => $icon
            ];

        }

    }

    public static function get($key)
    {

        if(isset($_SESSION['messages'][$key])){

            $flash = $_SESSION['messages'][$key];
            unset($_SESSION['messages'][$key]);
            return $flash;

        }

    }

}

?>