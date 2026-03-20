<?php 

namespace app\classes;

use app\database\activerecord\FindBy;
use app\models\Usuario_log;
use DateTime;
use DateTimeZone;

class VistoPorUltimo
{

    public static function calcular($id)
    {
        $userLog = new Usuario_log;

        $timeUser = $userLog->execute(new FindBy('id_usuario', $id));

        $data = new DateTime($timeUser->ultima_atividade, new DateTimeZone('America/Sao_Paulo'));
        
        $agora = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

        $vistoPorUltimo = $agora->diff($data);

        if($vistoPorUltimo->y > 0 ){
            return "há ". $vistoPorUltimo->y . ($vistoPorUltimo->y == 1 ? 'ano' : 'anos');
        }elseif($vistoPorUltimo->m > 0){
            return "há ". $vistoPorUltimo->m . ($vistoPorUltimo->m == 1 ? 'mês' : 'meses');
        }elseif($vistoPorUltimo->d > 0){
            return "há ". $vistoPorUltimo->d . ($vistoPorUltimo->d == 1 ? 'dia' : 'dias');
        }elseif($vistoPorUltimo->h > 0){
            return "há ". $vistoPorUltimo->h . ($vistoPorUltimo->h == 1 ? 'hora' : 'horas');
        }elseif($vistoPorUltimo->i > 0){
            return "há ". $vistoPorUltimo->i . ($vistoPorUltimo->i == 1 ? 'minuto' : 'minutos');
        }else{
            return "há alguns segundos";
        }

    }

}

?>