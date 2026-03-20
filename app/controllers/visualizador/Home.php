<?php 

namespace app\controllers\visualizador;

use app\classes\BlockAccessLevel;
use app\interfaces\ControllerInterface;
use app\classes\BlockSomeReason;

class Home implements ControllerInterface
{

    public string $view;
    public string $master;
    public array $data = [];

    public function __construct()
    {
       
        $blockMethods = get_class_methods($this);

        BlockSomeReason::block($this, ['show', 'update', 'destroy', 'edit', 'store']);
        BlockAccessLevel::block($this, $blockMethods, ['visualizador']);

    }

    public function index(array $args)
    {

        $this->view = 'visualizador/home.php';
        $this->master = 'visualizador/master.php';
        $this->data = [
            'title' => 'Home'
        ];

    }

    public function store()
    {
        throw new \Exception('Not implemented');
    }

    public function update(array $args)
    {
        throw new \Exception('Not implemented');
    }

    public function show(array $args)
    {
        throw new \Exception('Not implemented');
    }

    public function destroy(array $args)
    {
        throw new \Exception('Not implemented');
    }

    public function edit(array $args)
    {
        throw new \Exception('Not implemented');
    }

}

?>