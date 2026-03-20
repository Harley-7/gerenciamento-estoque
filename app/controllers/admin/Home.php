<?php 

namespace app\controllers\admin;

use app\classes\BlockAccessLevel;
use app\classes\BlockSomeReason;
use app\interfaces\ControllerInterface;

class Home implements ControllerInterface
{

    public string $view;
    public string $master;
    public array $data = [];

    public function __construct()
    {

        $blockMethods = get_class_methods($this);

        BlockSomeReason::block($this, ['show', 'update', 'destroy', 'edit', 'store']);
        BlockAccessLevel::block($this, $blockMethods, ['admin']);
        
    }

    public function index(Array $args)
    {

        $this->view = 'admin/home.php';
        $this->master = 'admin/master.php';
        $this->data = [
            'title' => "Home"
        ];

    }

    public function show(array $args)
    {
        throw new \Exception('Not implemented');
    }

    public function update(array $args)
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

    public function store()
    {
        throw new \Exception('Not implemented');
    }

}

?>