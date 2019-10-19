<?php


namespace viking\app\model;

use viking\core\database\connection;
use viking\core\config;

use PDO;

class model
{
    public $con;

    public function __construct() 
    {
        $this->con = connection::getConnetion(
            config::database()
        );
    }

    public function fetchAll($table, array $select, string $where='')
    {
        $sql = $this->queryBuilder($table, $select, $where);

        $res = $this->con->prepare($sql);

        $res->execute();

        return $res->fetchAll(PDO::FETCH_CLASS);
    }

    private function queryBuilder(string $table, array $select, string $where='') 
    {

        $sql = 'SELECT ' .implode(', ', $select). ' FROM ' . $table;

        if (!empty($where)) {
            $sql .= ' WHERE ' . $where;
        }

        return $sql;
    }

    public function fetch(string $table, array $select, string $where)
    {
        $sql = $this->queryBuilder($table, $select, $where);

        echo $sql;

        $res = $this->con->prepare($sql);

        $res->execute();

        return $res->fetch();
    }

    public function insertTable(string $table, array $fields)
    {
        $sql = 'INSERT INTO ' . $table . ' ('.implode(', ', array_keys($fields)).') 
            VALUES ('.implode(', ', $fields).')';
        
        try {
            $res = $this->con->prepare($sql);

            $res->execute($parameters);

            return true;
        } catch (\Exception $e) {
            echo 'Falhamos ao adicionar um item';
            echo $table;
            echo '<br>';
            return false;
        }
        
    }

    public function wrapperFields($fields, $fieldsLike, $fieldsEqual)
    {
        foreach ($fields as $key => $value) {
            if (in_array($key, $fieldsLike)) {
                $fields_like [$key] = wrapperAndSlashes(wrapperAndSlashes($value, '%'));
            }else{
                $fields_equal [$key] = wrapperAndSlashes($value);
            }
        }

        return ['like' => $fields_like, 'equal' => $fields_equal];
    }
}
