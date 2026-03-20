<?php 

namespace app\database\activerecord;

use app\interfaces\ActiveRecordExecuteInterface;
use app\interfaces\ActiveRecordInterface;
use Exception;

class Delete implements ActiveRecordExecuteInterface
{
    
    public function __construct(private string $field, private string|int $value)
    {
        
    }

    public function execute($connection ,ActiveRecordInterface $activeRecordInterface)
    {
        try {

            $query = $this->createQuery($activeRecordInterface);
            
            $prepare = $connection->prepare($query);
            $prepare->execute([

                $this->field => $this->value

            ]);

            return $prepare->rowCount();
            
        } catch (\Throwable $th){
            echo formatException($th); 
        }

    }

    private function createQuery($activeRecordInterface)
    {   

        if($activeRecordInterface->getAttributes())
        {
           throw new Exception("Para executar o delete não é necessário passar atributos");
        }

        $sql = "delete from {$activeRecordInterface->getTable()} ";
        $sql .= "where {$this->field} = :{$this->field}";

        return $sql;

    }

}


?>