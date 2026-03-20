<?php 

namespace app\database\selectbuilder;

use app\interfaces\SelectBuilderInterface;

class SelectBuilder
{

    private string $table;
    private string $fields;
    private array $joins = [];
    private string $where;
    private array $orderBy = [];
    private string $limit;

    public function table($table){
        $this->table = $table;
        return $this;
    }

    public function fields($fields = '*'){
        $this->fields = $fields;
        return $this;
    }

    public function join($table, $on, $type = 'INNER'){
        $this->joins[] = strtoupper($type). " JOIN " . $table . " ON " . $on;
        return $this;
    }

    public function where($where){
        $this->where = $where;
        return $this;
    }

    public function orderBy($column, $direction = 'ASC'){
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    public function limit($limit){
        $this->limit = $limit;
        return $this;
    }

    public function build()
    {

        $sql = "SELECT ". $this->fields . " FROM ". $this->table;

        if(!empty($this->joins)){
            $sql .= " ". implode(' ', $this->joins);
        }

        if(!empty($this->where)){
            $sql .= " WHERE ". $this->where;
        }

        if (!empty($this->orderBy)) {
            $sql .= " ORDER BY " . implode(", ", $this->orderBy);
        }

        if (!empty($this->limit)) {
            $sql .= " LIMIT " . $this->limit;
        }

        return $sql;

    }


}

?>