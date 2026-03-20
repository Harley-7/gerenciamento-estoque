<?php 
namespace app\controllers;
    
class Home {

    public array $data = [];
    public string $master;
    public string $view;

    public function index(){
       $this->master = 'master.php';  
       $this->view = 'home.php';
       $this->data = [
            'title' => 'Home'
       ];
    }

}

?>