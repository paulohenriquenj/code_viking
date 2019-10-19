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

    public function fetchAll($table)
    {
        $res = $this->con->prepare("select * from {$table}");

        $res->execute();

        return $res->fetchAll(PDO::FETCH_CLASS);
    }

    public function fetch(string $table, array $select, string $where)
    {
        $sql = 'SELECT ' .implode(', ', $select). '
                FROM ' . $table . '
                WHERE ' . $where;


        $res = $this->con->prepare($sql);

        $res->execute();

        return $res->fetchAll(PDO::FETCH_CLASS);
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
}
