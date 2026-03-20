<?php 

namespace app\database\selectbuilder;

use app\database\connection\Connection;

class Execute
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function fetch($sqlCode)
    {
        $prepare = $this->connection->prepare($sqlCode);
        $prepare->execute();
        return $prepare->fetch();
    }

    public function fetchAll($sqlCode)
    {
        $prepare = $this->connection->prepare($sqlCode);
        $prepare->execute();
        return $prepare->fetchAll();
    }

}

?>