<?php 

namespace app\controllers;

class Error404
{

    public string $view;
    public array $data = [];
    public string $master;

    public function index()
    {

        $this->master = 'master.php';
        $this->view = 'error404.php';
        $this->data = [
            'title' => 'Error404'
        ];

    }


}

?>