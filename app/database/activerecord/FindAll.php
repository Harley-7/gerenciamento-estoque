<?php 

namespace app\database\activerecord;

use app\interfaces\ActiveRecordExecuteInterface;
use app\interfaces\ActiveRecordInterface;
use Exception;

class FindAll implements ActiveRecordExecuteInterface
{

    public function __construct(
        private array $where = [],
        private string|int $limit = '',
        private string|int $offset = '',
        private string $fields = '*'
    )
    {
        
    }

    public function execute($connection, ActiveRecordInterface $activeRecordInterface)
    {
        
        try {
            
            $query = $this->createQuery($activeRecordInterface);

            $prepare = $connection->prepare($query);
            $prepare->execute($this->where);

            return $prepare->fetchAll();

        } catch (\Throwable $th) {
            echo formatException($th);
        }

    }

    private function createQuery($activeRecordInterface)
    {

        if(count($this->where) > 1)
        {
            throw new Exception("No where só pode passar um índice");
        }

        $where = array_keys($this->where);
        $sql = "select {$this->fields} from {$activeRecordInterface->getTable()}";
        $sql .= (!$this->where) ? "" : " where {$where[0]} = :{$where[0]}";
        $sql .= (!$this->limit) ? "" : " limit {$this->limit}";
        $sql .= ($this->offset != "") ? " offset {$this->offset}" : "";

        return $sql;

    }

}

?>