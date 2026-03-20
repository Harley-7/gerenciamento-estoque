<?php 

namespace app\interfaces;

interface ActiveRecordInterface
{

    public function __set($name, $value);
    public function __get($name);
    public function getTable();
    public function getAttributes();

}

?>