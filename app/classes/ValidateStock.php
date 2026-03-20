<?php 

namespace app\classes;

use app\database\activerecord\FindBy;
use app\interfaces\ValidateInterface;
use app\models\Stock;
use app\classes\Flash;
use app\classes\Old;
use app\database\connection\Connection;

class ValidateStock implements ValidateInterface{

    public function handle($field, $param)
    {

       $string = strip_tags($_POST[$field]);

       $error = false;

       if($string === ""){
            Flash::set($field, "Este campo é obrigatório. Por favor, preencha para continuar.");
            $error = true;
       }

       $stock = new Stock;
       $stockExist = $stock->execute(Connection::connect(), new FindBy('stock_name', $string));

       if($stockExist){
            Flash::set($field, "Nome de estoque indisponível. Escolha outro.", "info");
            $error = true;
       }
       
       Old::set($field, $string);
       return [$error, $string];

    }

}

?>