<?php 

namespace app\database\connection;

use PDO;
use PDOException;

class Connection
{

    private static $pdo = null;

    public static function connect()
    {

        try {
            
            if(!static::$pdo){

                static::$pdo = new PDO($_ENV['DB_CONNECTION'].":host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);

            }

            return static::$pdo;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

}

?>