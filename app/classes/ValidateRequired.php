<?php 

namespace app\classes;

use app\interfaces\ValidateInterface;
use app\classes\Flash;
use app\classes\Old;

class ValidateRequired implements ValidateInterface
{

    public function handle($field, $param)
    {
        
       $string = strip_tags($_POST[$field]);

       $error = false;

       if($string === ""){
            Flash::set($field, "Este campo é obrigatório. Por favor, preencha para continuar.");
            $error = true;

       }

       Old::set($field, $string);
       return [$error, $string];

    }

}


?>