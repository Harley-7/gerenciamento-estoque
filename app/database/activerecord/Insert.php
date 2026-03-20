<?php 

namespace app\database\activerecord;

use app\interfaces\ActiveRecordExecuteInterface;
use app\interfaces\ActiveRecordInterface;

class Insert implements ActiveRecordExecuteInterface
{

    public function execute($connection, ActiveRecordInterface $activeRecordInterface)
    {
        
        $query = $this->createQuery($activeRecordInterface);

        $prepare = $connection->prepare($query);
        
        return $prepare->execute($activeRecordInterface->getAttributes());
        
    }

    private function createQuery($activeRecordInterface)
    {
        //insert into (name, email) values (:name, :email)

        $sql = "insert into {$activeRecordInterface->getTable()} (";
        $sql .= implode(', ', array_keys($activeRecordInterface->getAttributes())) . ") values (";
        $sql .= ":".implode(', :', array_keys($activeRecordInterface->getAttributes())). ")";

        return $sql;
    }


}


?>