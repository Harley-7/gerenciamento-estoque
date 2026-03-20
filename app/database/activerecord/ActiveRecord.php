<?php

namespace app\database\activerecord;

use app\interfaces\ActiveRecordExecuteInterface;
use app\interfaces\ActiveRecordInterface;
use ReflectionClass;

abstract class ActiveRecord implements ActiveRecordInterface
{

    protected $table = null;

    protected $attributes = [];

    public function __construct()
    {
        if(!$this->table){

            $this->table = strtolower((new ReflectionClass($this))->getShortName());

        }
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function execute($connection, ActiveRecordExecuteInterface $activeRecordExecuteInterface)
    {
        return $activeRecordExecuteInterface->execute($connection, $this);
    }

}

?>