<?php 

namespace app\controllers\api;

use app\classes\BlockAccessLevel;
use app\database\activerecord\FindAll;
use app\database\activerecord\Transaction;
use app\database\activerecord\Update;
use app\database\connection\Connection;
use app\interfaces\ApiInterface;
use app\models\Produtos;

class Products implements ApiInterface{

    public function __construct()
    {
        
        $blockMethods = get_class_methods($this);

        BlockAccessLevel::block($this, $blockMethods, ["admin", "operador"]);

    }

    public function getAll(){
        header("Content-Type: application/json");
           
        $products = (new Produtos)->execute(Connection::connect(), new FindAll(where:["id_stock" => $_SESSION['user']->id_stock], fields:"id, imagem_path, produto, preco_venda, estoque"));

        echo json_encode($products);

    }

    public function getById()
    {
        throw new \Exception('Not implemented');
    }

    public function create()
    {
        throw new \Exception('Not implemented');
    }

    public function update()
    {
        
        $listJson = file_get_contents("php://input");
        $listProducts = json_decode($listJson);

        if(!$listProducts){
            echo json_encode(["message" => "Falha a lista está vazia",
                              "icon" => "error"]);
        }

        try {
            Transaction::open();

            $stock = new Produtos;
    
            foreach($listProducts as $product){
                $stock->estoque = ($product->estoque - $product->quantidade);
                $stock->execute(Transaction::get(), new Update("id", $product->id));
            }

            $updated = Transaction::close();
        } catch (\Throwable $th) {
            Transaction::rollback();
            echo formatException($th);
        }

        if($updated){
            echo json_encode(["message" => "Venda realizada com sucesso", "icon" => "success"]);
        }else{
            echo json_encode(["message" => "Falha ao realizar venda", "icon" => "error"]);
        }

    }

    public function delete()
    {
        throw new \Exception('Not implemented');
    }

}

?>