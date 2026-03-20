<?php 

namespace app\core;

use app\interfaces\AppInterface;

use Exception;

class MyApp
{

    private $controller;

    public function __construct(private AppInterface $appInterface)
    {
        
    }

    public function controller()
    {

        $controller = $this->appInterface->controller();
        $method = $this->appInterface->method($controller);
        $params = $this->appInterface->params();

        $this->controller = new $controller;
        $this->controller->$method($params);

    }

    public function view()
    {

        $uri = Uri::uri();
        $folder = FolderExtract::extract($uri);

        if($_SERVER['REQUEST_METHOD'] === 'GET' && $folder != "api")
        {

            if(!isset($this->controller->master)){
                throw new Exception("A propriedade master não está declarada no controller");
            }

            if(!isset($this->controller->data)){
                throw new Exception("A propriedade data não está declarada no controller");
            }

            if(!array_key_exists('title', $this->controller->data)){
                throw new Exception("o índice 'title' é obrigatório na propriedade data");
            }

            extract($this->controller->data);
            require VIEW_PATH.$this->controller->master;
        
        }

    }



}


?>