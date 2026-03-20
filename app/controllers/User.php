<?php 

namespace app\controllers;

use app\classes\BlockNotLogged;
use app\classes\BlockSomeReason;
use app\classes\Flash;
use app\classes\Validate;
use app\database\activerecord\Delete;
use app\database\activerecord\FindBy;
use app\database\activerecord\Update;
use app\database\connection\Connection;
use app\database\selectbuilder\SelectBuilder;
use app\database\selectbuilder\Execute;
use app\interfaces\ControllerInterface;
use app\models\Usuarios;

class User implements ControllerInterface
{

     public string $view;
     public string $master;
     public array $data = [];

     public function __construct()
     {  
        $blockMethods = get_class_methods($this);

        BlockSomeReason::block($this, ['show', 'store']);
        BlockNotLogged::block($this, $blockMethods);
     }

     public function index(array $args){

        $select = (new SelectBuilder)->table('usuarios u')
        ->fields('u.id, u.firstname, u.lastname, u.email, u.access_level, ul.ultima_atividade, ul.status_online')
        ->join('usuario_log ul', 'u.id = ul.id_usuario', 'left')
        ->where("$args[0] = $args[1]")
        ->build();

        if($_SESSION['user']->id != $args[1]){
            return redirect('/'. $_SESSION['user']->access_level);
        }

        $user = (new Execute)->fetch($select);

        $this->view = 'userFunctions.php';
        $this->master = "{$_SESSION['user']->access_level}/master.php";
        $this->data = [
            'title' => 'Funções de Usuário',
            'user' => $user
        ];

     }

     public function edit(array $args){

        $user = (new Usuarios)->execute(Connection::connect(), new FindBy('id', $_SESSION['user']->id));

        $this->view = 'userEdit.php';
        $this->master = "{$_SESSION['user']->access_level}/master.php";
        $this->data = [
            'title' => "Atualizar Dados",
            'user' => $user
        ];

     }

     public function edit_password(){

        $this->view = 'userEditPassword.php';
        $this->master = "{$_SESSION['user']->access_level}/master.php";
        $this->data = [
            'title' => "Atualizar Senha"
        ];

     }

     public function edit_email(){

        $user = (new Usuarios)->execute(Connection::connect(), new FindBy('id', $_SESSION['user']->id, 'email'));

        $this->view = 'userEditEmail.php';
        $this->master = "{$_SESSION['user']->access_level}/master.php";
        $this->data = [
            'title' => "Atualizar E-mail",
            'user' => $user
        ];

     }

     public function update(array $args)
     {

        $validate = new Validate;
        $validate->handle([
           'firstname' => [REQUIRED],
           'lastname' => [REQUIRED],
        ]);

        if($validate->error){
            return redirect("/user/edit");
        }

        $user = new Usuarios;
        $user->firstname = $validate->data['firstname'];
        $user->lastname = $validate->data['lastname'];
        $updated = $user->execute(Connection::connect(), new Update('id', $_SESSION['user']->id));

        if($updated){
            Flash::set('updatedUser', 'Dados Atualizado com sucesso',icon: 'success');
            return redirect('/user/edit');
        }else{
            Flash::set('updatedUser', 'Não foi possível atualizar os dados. Tente novamente');
            return redirect('/user/edit');
        }

     }

     public function update_password(){

        $validate = new Validate;
        $validate->handle([
           'password' => [REQUIRED, PASSWORD.":8"],
           'password_confirm' => [REQUIRED, PASSWORD.":8"]
         ]);
         
         if($validate->error){
            return redirect('/user/edit_password');
         }
         
         if($_POST['password'] !== $_POST['password_confirm']){
 
            Flash::set('updatedUser', 'As senhas não coincidem. Verifique e tente novamente');
            return redirect('/user/edit_password');
 
         }

         $user = new Usuarios;
         $user->password = password_hash($validate->data['password'], PASSWORD_DEFAULT);
         $updated = $user->execute(Connection::connect(), new Update('id', $_SESSION['user']->id));

         if($updated){
            Flash::set('updatedUser', 'Senha atualizada com sucesso',icon: 'success');
            return redirect('/user/edit_password');
         }else{
            Flash::set('updatedUser', 'Não foi possível atualizar a senha. Verifique os dados informados e tente novamente');
            return redirect('/user/edit_password');
         }

     }

     public function update_email(){

         $validate = new Validate;
         $validate->handle([
            'email' => [REQUIRED, EMAIL, UNIQUE_EMAIL]
         ]);

         if($validate->error){
            return redirect('/user/edit_email');
         }

         $user = new Usuarios;
         $user->email = $validate->data['email'];
         $updated = $user->execute(Connection::connect(), new Update('id', $_SESSION['user']->id));

         if($updated){
            Flash::set('updatedUser', 'E-mail atualizado com sucesso',icon: 'success');
            return redirect('/user/edit_email');
         }else{
            Flash::set('updatedUser', 'Não foi possível atualizar seu e-mail. Por favor, tente novamente');
            return redirect('/user/edit_email');
         }

     }


     public function store()
     {
        throw new \Exception('Not implemented');
     }

     public function show(array $args)
     {
        throw new \Exception('Not implemented');
     }


     public function alert_destroy(){

         $this->view = 'alertDeleteAccount.php';
         $this->master = "{$_SESSION['user']->access_level}/master.php";
         $this->data = [
            'title' => 'Alerta de exclusão de conta'
         ];

     }

     public function destroy(array $args)
     {
        
         $user = new Usuarios;

         $deleted = $user->execute(Connection::connect(), new Delete("id", $_SESSION['user']->id));

         if($deleted){
            session_destroy();
            return redirect('/');
         }else{
            Flash::set('deletedAccount', 'Falha ao tentar excluir a conta');
            return redirect('/user/alert_destroy');
         }

     }

}

?>