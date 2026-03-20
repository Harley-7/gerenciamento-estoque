<?php 

namespace app\database\activerecord;

use app\database\connection\Connection;
use PDO;

class Transaction
{

    private static ?PDO $connection = null;

    public static function open(){

        self::$connection = Connection::connect();
        self::$connection->beginTransaction();

    }

    public static function get(){
        if(self::$connection){
            return self::$connection;
        }
    }

    public static function rollback(){
        if(self::$connection){
            self::$connection->rollBack();
        }
    }

    public static function close(){
        if(self::$connection){
            $result = self::$connection->commit();
            self::$connection = null;
            return $result;
        }
    }

}

?>