<?php 

namespace app\controllers;

use app\classes\BlockLogged;
use app\classes\Flash;
use app\classes\Validate;
use app\database\activerecord\FindBy;
use app\interfaces\ControllerInterface;
use app\models\Usuarios;
use app\classes\BlockSomeReason;
use app\database\activerecord\Insert;
use app\database\activerecord\Transaction;
use app\database\activerecord\Update;
use app\database\connection\Connection;
use app\models\Usuario_log;
use DateTime;
use DateTimeZone;

class Login implements ControllerInterface
{

    public array $data = [];
    public string $master;
    public string $view;

    public function __construct()
    {
        BlockSomeReason::block($this, ['show', 'update', 'edit']);
        BlockLogged::block($this, ['index', 'store']);
    }

    public function index(Array $args)
    {

        $this->view = 'login.php';
        $this->master = 'master.php';
        $this->data = [
            'title' => 'Login'
        ];

    }

    public function store()
    {

        $validate = new Validate;
        $validate->handle([
            'email' => [REQUIRED, EMAIL],
            'password' => [REQUIRED]
        ]);

        if($validate->error){
            return redirect("/login");
        }

        try {
            Transaction::open();  
            $connection = Transaction::get();  
            
            $user = new Usuarios;
            $userFound = $user->execute($connection, new FindBy('email', $validate->data['email']));
    
            if(!$userFound)
            {
                Flash::set('login', 'Usuário ou senha inválidos');
                return redirect('/login');
            }
    
            $passwordMatch = password_verify($validate->data['password'], $userFound->password);
    
            if(!$passwordMatch)
            {
                Flash::set('login', 'Usuário ou senha inválidos');
                return redirect('/login');
            }
    
            $userLog = new Usuario_log;
    
            if($userLog->execute($connection, new FindBy('id_usuario', $userFound->id))){
                $data = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
                $userLog->status_online = 1;
                $userLog->ultima_atividade = $data->format('Y-m-d H:i:s');
                $userLog->execute($connection, new Update('id_usuario', $userFound->id));
            }else{
                $userLog->id_usuario = $userFound->id;
                $userLog->status_online = 1;
                $userLog->execute($connection, new Insert);
            }
    
            Transaction::close();

            unset($userFound->password);
    
            $_SESSION['user'] = $userFound;

            return redirect('/'.$userFound->access_level);

        } catch (\Throwable $th) {
            echo formatException($th);
            Transaction::rollback();
        }

    }

    public function destroy(Array $args)
    {
           
        if(isset($_SESSION['user'])){

            $userLog = new Usuario_log;
            $data = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $userLog->status_online = 0;
            $userLog->ultima_atividade = $data->format("Y-m-d H:i:s");
            $userLog->execute(Connection::connect(), new Update('id_usuario', $_SESSION['user']->id));

        }       

        session_destroy();

        return redirect('/login');

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
}


?>