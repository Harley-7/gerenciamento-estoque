<?php 

namespace app\classes;

use app\interfaces\ValidateInterface;

class ValidatePassword implements ValidateInterface
{

    public function handle($field, $param)
    {
        
        $password = $_POST[$field];

        $error = false; 

        if(strlen($password) < $param ){

            Flash::set($field, "A senha deve ter no mínimo $param caracteres.");
            $error = true;

        }

        Old::set($field, $password);
        return [$error, $password];

    }

}

?>