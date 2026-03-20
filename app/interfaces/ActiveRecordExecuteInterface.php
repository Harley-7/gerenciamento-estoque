<?php 

namespace app\interfaces;

interface ActiveRecordExecuteInterface
{
    public function execute($connection, ActiveRecordInterface $activeRecordInterface);
}


?>