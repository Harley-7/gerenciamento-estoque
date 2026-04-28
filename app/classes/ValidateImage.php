<?php 

namespace app\classes;

use app\database\activerecord\FindBy;
use app\database\connection\Connection;
use app\interfaces\ValidateInterface;
use app\models\Stock;

class ValidateImage implements ValidateInterface
{

    public function handle($field, $param)
    {

        if(isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK && $_FILES[$field]['size'] > 0){

            $imagem = $_FILES[$field];

            $error = false;

            if($imagem['error']){
                Flash::set('imagem', 'Falha ao enviar imagem.');
                return [$error = true, null];
            }

            if($imagem['size'] > 2097152){
                Flash::set('imagem', 'O tamanho do arquivo e muito grande. MAX: 2MB');
                return [$error = true, null];
            }

            if(!$param){
                Flash::set('imagem', 'Subpasta não informada');
                return [$error = true, null];
            }

            $extensions = ['jpg', 'jpeg', 'png', 'webp'];
            $info = pathinfo($imagem['name']);

            $stockName = (new Stock)->execute(Connection::connect(), new FindBy('id', $_SESSION['user']->id_stock, 'stock_name'));  
            $folder = 'assets/img/stocks/'.$stockName->stock_name.'/'.$param.'/';
            $nameFile = $info['filename'];
            $extension = strtolower($info['extension']);

            if(!in_array($extension, $extensions)){
                Flash::set('imagem', 'Tipo de arquivo não aceito. Tipos de arquivo aceito: jpg, jpeg, webp e png. ');
                return [$error = true, null];
            }

            $path = $folder . uniqid() ."_". $nameFile .".". $extension;

            return [$error, ['path' => $path, 'tmp_name' => $imagem['tmp_name']]];

        }else{
            Flash::set('imagem', 'Imagem não enviada');
            return [$error = true, null];
        }

    }

}

?>