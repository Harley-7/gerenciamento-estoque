<?php 

namespace app\database\activerecord;

use app\interfaces\ActiveRecordExecuteInterface;
use app\interfaces\ActiveRecordInterface;
use Exception;

class Update implements ActiveRecordExecuteInterface
{

    public function __construct(private string $field, private string|int $value)
    {
        
    }
    
    public function execute($connection, ActiveRecordInterface $activeRecordInterface)
    {

        try {

            $query = $this->createQuery($activeRecordInterface);

            $attibutes = array_merge($activeRecordInterface->getAttributes(), [
                $this->field => $this->value
            ]);

            $prepare = $connection->prepare($query);
            $prepare->execute($attibutes);
            return $prepare->rowCount();
            
        } catch (\Throwable $th) {
            echo formatException($th);
        }
        
    }

    private function createQuery($activeRecordInterface)
    {
        if(array_key_exists('id', $activeRecordInterface->getAttributes())){
            throw new Exception("O campo id não pode ser passado para o update");
        }

        $sql = "update {$activeRecordInterface->getTable()} set ";

        foreach($activeRecordInterface->getAttributes() as $key => $value)
        {
           
            $sql .= "{$key} =:{$key}, ";
    
        }

        $sql = rtrim($sql, ', ');
        $sql .= " where {$this->field} =:{$this->field}";

        return $sql;

    }

}


?>