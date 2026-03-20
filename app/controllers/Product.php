<?php 

namespace app\controllers;

use app\classes\BlockNotLogged;
use app\classes\BlockSomeReason;
use app\classes\Flash;
use app\classes\Validate;
use app\database\activerecord\Insert;
use app\interfaces\ControllerInterface;
use app\models\Produtos;
use app\database\connection\Connection;

class Product implements ControllerInterface
{

    public string $view;
    public string $master;
    public array $data = [];

    public function __construct()
    {
        BlockSomeReason::block($this, ['show', 'update', 'edit', 'destroy']);
        BlockNotLogged::block($this, ['index', 'store']);
    }

    public function index(array $args)
    {
        
        $this->view = 'createProduct.php';
        $this->master = $_SESSION['user']->access_level."/master.php";
        $this->data = [
            'title' => 'Adicionar Produto'
        ];

    }

    public function store()
    {

        if(empty($_POST)){
            return redirect('/error404');
        }

        $validate = new Validate;

        $validate->handle([
            'imagem' => [IMAGE],
            'produto' => [REQUIRED],
            'preco_compra' => [REQUIRED],
            'preco_venda' => [REQUIRED],
            'estoque' => [REQUIRED],
            'estoque_minimo' => [REQUIRED],
            'data_validade' => [REQUIRED],
            'lote' => [REQUIRED],
            'marca' => [REQUIRED]
        ]);

        if($validate->error){
            return redirect("/product");
        }

        $image = $validate->data['imagem'];

        $moved = move_uploaded_file($image['tmp_name'], $image['path']);

        if(!$moved){
            Flash::set('imagem', 'Falha ao fazer o upload da imagem');
            return redirect("/product");
        }
            
        $produto = new Produtos;
        $produto->imagem = $image['path'];

        foreach($validate->data as $field => $value){

            if($field != "imagem"){
                $produto->$field = $value; 
            }

        }

        $produto->unidade_medida = $_POST['unidade_medida'];
        $produto->categoria = $_POST['categoria'];
        $produto->id_stock = $_SESSION['user']->id_stock;
    
        $created = $produto->execute(Connection::connect(), new Insert);   

        if($created){
            Flash::set('product', 'Produto adicionado com sucesso', icon: 'success');
            return redirect('/product');
        }else{
            Flash::set('product', 'Falha ao tentar adicionar um novo produto');
            return redirect('/product');
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