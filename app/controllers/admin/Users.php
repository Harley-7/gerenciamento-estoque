<?php 

namespace app\controllers\admin;

use app\classes\BlockAccessLevel;
use app\classes\BlockSomeReason;
use app\classes\Flash;
use app\classes\Validate;
use app\database\activerecord\Delete;
use app\database\activerecord\FindBy;
use app\database\activerecord\Insert;
use app\database\activerecord\Update;
use app\database\connection\Connection;
use app\database\selectbuilder\SelectBuilder;
use app\database\selectbuilder\Execute;
use app\interfaces\ControllerInterface;
use app\models\Usuarios;

class Users implements ControllerInterface
{

    public string $view;
    public string $master;
    public array $data = [];

    public function __construct()
    {

        $blockMethods = get_class_methods($this);

        BlockSomeReason::block($this, ['show']);
        BlockAccessLevel::block($this, $blockMethods, ['admin']);
    }

    public function index(array $args){

        $id_stock = $_SESSION['user']->id_stock;
            
        $select = (new SelectBuilder)->table('usuarios u')
        ->fields('u.id, u.imagem_path, u.firstname, u.lastname, u.access_level, ul.status_online')
        ->join('usuario_log ul', 'u.id = ul.id_usuario', 'left')
        ->where("u.id_stock = $id_stock")
        ->build();

        $users = (new Execute)->fetchAll($select);

        $this->view = 'admin/users.php';
        $this->master = 'admin/master.php';
        $this->data = [
            'title' => 'Usuários',
            'users' => $users
        ];

    }

    public function details(array $args){
    
        $select = (new SelectBuilder)->table('usuarios u')
        ->fields('u.id, u.imagem_path, u.firstname, u.lastname, u.email, u.access_level, u.id_stock, ul.ultima_atividade, ul.status_online')
        ->join('usuario_log ul', 'u.id = ul.id_usuario', 'left')
        ->where("$args[0] = $args[1]")
        ->build();
        
        $user = (new Execute)->fetch($select);
        
        if(empty($user)){
            return redirect("/".$_SESSION['user']->access_level);
        }
            
        if($user->id_stock != $_SESSION['user']->id_stock){
            return redirect("/".$_SESSION['user']->access_level);
        }  

        $photo = $user->imagem_path;
        unset($user->imagem_path);
        
        $this->view = 'admin/userDetails.php';
        $this->master = 'admin/master.php';
        $this->data = [
            'title' => 'Detalhes do Usuário',
            'user' => $user,
            'photo' => $photo
        ];

    }

    public function alert(Array $args){

           
        $user = (new Usuarios)->execute(Connection::connect(), new FindBy($args[0], $args[1], 'id, firstname, lastname, id_stock'));

        if(empty($user)){
            redirect("/".$_SESSION['user']->access_level);
        }

        if($user->id_stock != $_SESSION['user']->id_stock){
            redirect("/".$_SESSION['user']->access_level);
        }   

        $this->view = 'admin/alertDeleteUser.php';
        $this->master = 'admin/master.php';
        $this->data = [
            'title' => 'Alert',
            'user' => $user
        ];

    }

    public function destroy(array $args){

        if(!$args[0] || !$args[1]){
            return redirect("/". $_SESSION['user']->access_level);
        }

        $connection = Connection::connect();

        $user = new Usuarios;
        $find = $user->execute($connection, new FindBy($args[0], $args[1], "id_stock"));

        if(empty($find)){
            return redirect("/". $_SESSION['user']->access_level);
        }

        if($find->id_stock != $_SESSION['user']->id_stock){
            return redirect("/". $_SESSION['user']->access_level);
        }

        $deleteUser = $user->execute($connection, new Delete($args[0], $args[1]));

        if($deleteUser){
            Flash::set('deleteUser', 'Usuário deletado com sucesso', icon: 'success');
            return redirect('/admin/users');
        }else{
            Flash::set('deleteUser', 'Falha ao tentar deletar usuário');
            return redirect('/admin/users/alert/'.$args[0].'/'.$args[1]);
        }

    }

    public function create(){

        $this->view = "admin/createUser.php";
        $this->master = "admin/master.php";
        $this->data = [
            "title" => "Criar um novo usuário"
         ];

    }

    public function store()
    {
        
        if(empty($_POST)){
            return redirect("/error404");
        }

        $validate = new Validate;
        $validate->handle([
            'firstname' => [REQUIRED],
            'lastname' => [REQUIRED],
            'email' => [REQUIRED, UNIQUE_EMAIL, EMAIL],
            'password' => [REQUIRED, PASSWORD.":8"]
        ]);

        if($validate->error){
            return redirect("/admin/users/create");
        }
 
        $userCreate = new Usuarios;

        foreach($validate->data as $field => $value){
            $userCreate->$field = $value;
        }
        $userCreate->password = password_hash($userCreate->password, PASSWORD_DEFAULT);
        $userCreate->access_level = $_POST['access_level'];
        $userCreate->id_stock = $_SESSION['user']->id_stock;

        $createdUser = $userCreate->execute(Connection::connect(), new Insert);

        if($createdUser){
            Flash::set("createdUser", "Usuário adicionado com sucesso",icon: "success");
            return redirect("/admin/users/create");
        }else{
            Flash::set("createdUser", "Falha ao tentar adicionar um novo usuário");
            return redirect("/admin/users/create");
        }

    }

    public function show(array $args)
    {
        throw new \Exception('Not implemented');
    }

    public function update(array $args)
    {
        
        if(empty($_POST)){
            return redirect("/error404");
        }
           
        $user = new Usuarios;
        $user->access_level = $_POST['access_level'];
        $updated = $user->execute(Connection::connect(), new Update($args[0], $args[1]));

        if($updated){
            Flash::set('updatedAcessLevel', 'Nível de acesso alterado com sucesso', icon: 'success');
            return redirect("/admin/users/edit/id/$args[1]/access_level/{$_POST['access_level']}");
        }else{
            Flash::set('updatedAcessLevel', 'Não foi possível alterar o nível de acesso');
            return redirect("/admin/users/edit/id/$args[1]/access_level/$args[2]");
        }

    }

    public function edit(array $args)
    {
            
        $user = (new Usuarios)->execute(Connection::connect(), new FindBy($args[0], $args[1], "access_level, id_stock, firstname"));

        if(empty($user)){
            return redirect("/".$_SESSION['user']->access_level);
        }

        if($user->id_stock != $_SESSION['user']->id_stock){
            return redirect("/".$_SESSION['user']->access_level);
        }   

        $this->master = 'admin/master.php';
        $this->view = 'admin/editAcessLevel.php';
        $this->data = [
            'title' => 'Alterar nível de acesso',
            'id' => $args[1],
            'access_level' => $user->access_level,
            'firstname' => $user->firstname
        ];
    }
}
?>