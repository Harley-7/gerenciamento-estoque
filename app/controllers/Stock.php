<?php 

namespace app\controllers;

use app\classes\BlockNotLogged;
use app\classes\BlockSomeReason;
use app\classes\Flash;
use app\classes\Validate;
use app\database\activerecord\Delete;
use app\database\activerecord\FindAll;
use app\database\activerecord\FindBy;
use app\database\activerecord\Update;
use app\interfaces\ControllerInterface;
use app\models\Produtos;
use DateTime;
use DateTimeZone;
use app\database\connection\Connection;

class Stock implements ControllerInterface
{

    public string $view;
    public string $master;
    public array $data;

    public function __construct()
    {
     
        $blockMethods = get_class_methods($this);

        BlockSomeReason::block($this, ['store',]);
        BlockNotLogged::block($this, $blockMethods);

    }

    public function index(Array $args){

        $produtos = new Produtos;

        $this->view = "stock.php";
        $this->master = $_SESSION['user']->access_level."/master.php";
        $this->data = [
            'title' => "Estoque",
            'produtos' => $produtos->execute(Connection::connect(), new FindAll(["id_stock" => $_SESSION['user']->id_stock]))
        ];

    }

    public function details_product(Array $args){

        $produto = (new Produtos)->execute(Connection::connect(), new FindBy($args[0], $args[1]));

        if(empty($produto)){
            return redirect("/".$_SESSION['user']->access_level);
        }

        if($produto->id_stock != $_SESSION['user']->id_stock){
            return redirect("/".$_SESSION['user']->access_level);
        }

        $this->view = "detailsProduct.php";
        $this->master = $_SESSION['user']->access_level."/master.php";
        $this->data = [
            'title' => "Detalhes do produto",
            'produto' => $produto
        ];

    }

    public function edit(Array $args){

        $produto = (new Produtos)->execute(Connection::connect(), new FindBy($args[0], $args[1]));

        if(empty($produto)){
            return redirect("/".$_SESSION['user']->access_level);
        }

        if($produto->id_stock != $_SESSION['user']->id_stock){
            return redirect("/".$_SESSION['user']->access_level);
        }

        $this->view = "editProduct.php";
        $this->master = $_SESSION['user']->access_level."/master.php";
        $this->data = [
            'title' => 'Editar dados da Mercadoria',
            'produto' => $produto,
            'id' => $args[1]
        ];   

    }

    public function update(array $args)
    {
        if(empty($_POST)){
            return redirect('/error404');
        }

        $fields = [
            'produto' => [REQUIRED],
            'preco_compra' => [REQUIRED],
            'preco_venda' => [REQUIRED],
            'estoque' => [REQUIRED],
            'estoque_minimo' => [REQUIRED],
            'data_validade' => [REQUIRED],
            'lote' => [REQUIRED],
            'marca' => [REQUIRED]
        ];

        if(!empty($_FILES['imagem']['name'])){
            $fields['imagem'] = [IMAGE];
        }

        $validate = new Validate;
        $validate->handle($fields);

        if($validate->error){
            return redirect('/stock/edit_product/id/'.$args[1]);
        }    

        $produto = new Produtos;
        $connection = Connection::connect();
        
        if(!empty($_FILES['imagem']['name'])){

            $imageOld = $produto->execute($connection, new FindBy($args[0], $args[1], 'imagem'));
            unlink($imageOld->imagem);
            
            $image = $validate->data['imagem'];

            $produto->imagem = $image['path'];

            $moved = move_uploaded_file($image['tmp_name'], $image['path']);

            if(!$moved){
                Flash::set('imagem', 'Falha ao fazer o upload da imagem');
                return redirect("/stock/edit/id/".$args[1]);
            }

        }

        foreach($validate->data as $field => $value){
            if($field != "imagem"){
                $produto->$field = $value;
            }
        }
        $produto->unidade_medida = $_POST['unidade_medida'];
        $produto->categoria = $_POST['categoria'];

        $updated = $produto->execute($connection, new Update($args[0], $args[1]));

        if($updated){
            Flash::set('productEdit', "Dados da mercadoria editados com sucesso", icon: "success");
            return redirect('/stock/edit/id/'.$args[1]);
        }else{
            Flash::set('productEdit', "Falha ao tentar editar dados da mercadoria");
            return redirect('/stock/edit/id/'.$args[1]);
        }

    }

    public function store()
    {
        throw new \Exception('Not implemented');
    }

    public function show(array $args)
    {

        $produto = (new Produtos)->execute(Connection::connect(), new FindBy("id", 20));
        $data = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        $formatedData = formatDate($data->format("Y-m-d H:i:s"));
    
        $this->view = 'sellProduct.php';
        $this->master = $_SESSION['user']->access_level."/master.php";
        $this->data = [
            "title" => 'Vender',
            "produto" => $produto,
            'data' => $formatedData
        ];

    }

    public function alert_destroy(Array $args){

        $produto = (new Produtos)->execute(Connection::connect(), new FindBy($args[0], $args[1]));

        if(empty($produto)){
            return redirect("/".$_SESSION['user']->access_level);
        }

        if($produto->id_stock != $_SESSION['user']->id_stock){
            return redirect("/".$_SESSION['user']->access_level);
        }

        $this->view = 'alertDeleteProduct.php';
        $this->master = $_SESSION['user']->access_level."/master.php";
        $this->data = [
            'title' => "Alerta",
            'produto' => $produto
        ];

    }

    public function destroy(array $args)
    {
        $produto = new Produtos;
        $connection = Connection::connect();
        $pathImage = $produto->execute($connection, new FindBy($args[0], $args[1], 'imagem'));
        $deleted = (new Produtos)->execute($connection, new Delete($args[0], $args[1]));

        if($deleted){
            unlink($pathImage->imagem);
            Flash::set('deleteProduct', "A mercadoria foi deletada com sucesso",icon: 'success');
            redirect('/stock');
        }else{
            Flash::set('deleteProduct', "Falha ao tentar deletar mercadoria");
            redirect('/stock/alert_destroy/'.$args[0].'/'.$args[1]);
        }
    }

}

?>