<?php 

namespace app\classes;

use app\interfaces\ValidateInterface;
use app\models\Usuarios;
use app\database\activerecord\FindBy;
use app\classes\Flash;
use app\database\connection\Connection;

class ValidateEmailUnique implements ValidateInterface
{

    public function handle($field, $param)
    {
        
        $email = filter_var($_POST[$field], FILTER_SANITIZE_EMAIL);

        $error = false;

        $user = new Usuarios;

        $emailExist = $user->execute(Connection::connect(), new FindBy('email', $email, 'email'));

        if($emailExist)
        {   
            Flash::set($field, "Verificamos que este e-mail já está registrado em nosso sistema.<br> Se você já possui uma conta, basta acessar com seu email e senha.", "info");
            $error = true;
        }

        return [$error, $email];

    }

}

?>