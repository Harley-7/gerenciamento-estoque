<?php 

namespace app\classes;

use app\interfaces\ValidateInterface;
use app\classes\Flash;
use app\classes\Old;

class ValidateEmail implements ValidateInterface
{

    public function handle($field, $param)
    {
        
        $email = filter_var($_POST[$field], FILTER_SANITIZE_EMAIL);
        
        $isEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        $error = false;

        if(!$isEmail){

            Flash::set($field, "O campo deve ser um endereço de e-mail válido.");

            $error = true;

        }

        Old::set($field, $isEmail);
        return [$error, $isEmail];

    }

}

?>