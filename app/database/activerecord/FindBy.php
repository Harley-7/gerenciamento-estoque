<?php 

namespace app\database\activerecord;

use app\interfaces\ActiveRecordExecuteInterface;
use app\interfaces\ActiveRecordInterface;

class FindBy implements ActiveRecordExecuteInterface
{

    public function __construct(private string $field, private string|int $value, private string $fields = "*")
    {
        
    }

    public function execute($connection, ActiveRecordInterface $activeRecordInterface)
    {
        
        try {
            
            $query = $this->createQuery($activeRecordInterface);

            $prepare = $connection->prepare($query);
            $prepare->execute([
                $this->field => $this->value
            ]);

            return $prepare->fetch();

        } catch (\Throwable $th) {
            echo formatException($th);
        }

    }

    private function createQuery($activeRecordInterface)
    {

        $sql = "select {$this->fields} from {$activeRecordInterface->getTable()} where {$this->field} = :{$this->field}";

        return $sql;

    }

}


?>