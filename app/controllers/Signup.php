<?php 

namespace app\controllers;

use app\classes\BlockLogged;
use app\classes\BlockSomeReason;
use app\classes\Flash;
use app\classes\Validate;
use app\database\activerecord\FindBy;
use app\database\activerecord\Insert;
use app\interfaces\ControllerInterface;
use app\models\Usuarios;
use app\models\Stock;
use app\database\activerecord\Transaction;

class Signup implements ControllerInterface
{

    public string $view;
    public array $data;
    public string $master;

    public function __construct()
    {
        BlockSomeReason::block($this, ['show', 'update', 'destroy', 'edit']);
        BlockLogged::block($this, ['index', 'store']);
    }

    public function index(array $args)
    {

        $this->view = 'signup.php';
        $this->data = [
            'title' => 'Signup'
        ];
        $this->master = 'master.php';

    }

    public function store(){

        if(empty($_POST)){
            return redirect('/error404');
        }
        
        $validate = new Validate;
        $validate->handle([
            'stock_name' => [STOCK],
            'firstname' => [REQUIRED],
            'lastname' => [REQUIRED],
            'email' => [REQUIRED, EMAIL, UNIQUE_EMAIL],
            'password' => [REQUIRED, PASSWORD.":8"],
        ]);

        if($validate->error){
            return redirect('/signup');
        }

        makeDirectory($validate->data['stock_name'], ['users', 'products']);

        try {
            Transaction::open();
            $connection = Transaction::get();
            
            $stock = new Stock;
            $stock->stock_name = $validate->data["stock_name"];
            $createdStock = $stock->execute($connection, new Insert);
    
            $stockId = $stock->execute($connection, new FindBy("stock_name", $validate->data["stock_name"], "id"));
    
            $userCreate = new Usuarios;
            $userCreate->firstname = $validate->data['firstname'];
            $userCreate->lastname = $validate->data['lastname'];
            $userCreate->email = $validate->data['email'];
            $userCreate->password = password_hash($validate->data['password'], PASSWORD_DEFAULT);
            $userCreate->access_level = "Admin";
            $userCreate->id_stock = $stockId->id;
            $createdUser = $userCreate->execute($connection, new Insert);

            Transaction::close();

        } catch (\Throwable $th) {
            echo formatException($th);
            Transaction::rollback();
        }

        if($createdStock && $createdUser){
            Flash::set('createdStock', 'Cadastrado com sucesso. Agora faça login para acessar os serviços disponíveis', 'success', 'success');

            return redirect('/login');
        }else{
            Flash::set('createdStock', 'Falha ao tentar criar estoque');
            return redirect('/signup');
        }

    }

    public function show(array $args)
    {
        throw new \Exception('Not implemented');
    }

    public function edit(array $args)
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

}

?>