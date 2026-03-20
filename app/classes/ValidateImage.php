<?php 

namespace app\classes;

use app\interfaces\ValidateInterface;

class ValidateImage implements ValidateInterface
{

    public function handle($field, $param)
    {

        if(isset($_FILES[$field])){

            $imagem = $_FILES[$field];

            $error = false;

            if($imagem['error']){
                Flash::set('imagem', 'Falha ao enviar imagem.');
                $error = true;
            }

            if($imagem['size'] > 2097152){
                Flash::set('imagem', 'O tamanho do arquivo e muito grande. MAX: 2MB');
                $error = true;
            }

            $extensions = ['jpg', 'jpeg', 'png', 'webp'];
            $info = pathinfo($imagem['name']);

            $folder = 'assets/img/produtos/';
            $nameFile = $info['filename'];
            $extension = strtolower($info['extension']);

            if(!in_array($extension, $extensions)){
                Flash::set('imagem', 'Tipo de arquivo não aceito. Tipos de arquivo aceito: jpg, jpeg, webp e png. ');
                $error = true;
            }

            $path = $folder . uniqid() ."_". $nameFile .".". $extension;

            return [$error, ['path' => $path, 'tmp_name' => $imagem['tmp_name']]];

        }

    }

}

?>