<?php


namespace viking\core\database;

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

    public function fetchAll($table, array $select, string $where='', string $limit='')
    {
        $sql = $this->queryBuilder($table, $select, $where, $limit);

        $res = $this->con->prepare($sql);

        $res->execute();

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    private function queryBuilder(string $table, array $select, string $where='', string $limit='') 
    {

        $sql = 'SELECT ' .implode(', ', $select). ' FROM ' . $table;

        if (!empty($where)) {
            $sql .= ' WHERE ' . $where;
        }

        if (!empty($limit)) {
            $sql .= ' LIMIT ' . $limit;
        }

        return $sql;
    }

    public function fetch(string $table, array $select, string $where)
    {
        $sql = $this->queryBuilder($table, $select, $where);

        $res = $this->con->prepare($sql);

        $res->execute();

        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(string $table, array $fields)
    {
        $sql = 'INSERT INTO ' . $table . ' ('.implode(', ', array_keys($fields)).') 
            VALUES ('.implode(', ', $fields).')';
 
        return $this->executeStatment($sql);
    }

    public function update(string $table, string $where, array $set)
    {
        $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', KeyValueToString($set)) . ' WHERE ' . $where;

        return $this->executeStatment($sql);

    }

    protected function executeStatment($sql)
    {
        try {
            $res = $this->con->prepare($sql);

            $res->execute();

            return true;
        } catch (\Exception $e) {
            echo 'Falhamos executar comando no banco de dados.';
            return false;
        }
    }

    public function totalOfRows(string $table)
    {
        $sql = 'SELECT COUNT(*) as total FROM ' . $table;

        $res = $this->con->prepare($sql);

        $res->execute();

        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function wrapperFields($fields, $fieldsLike, $fieldsEqual=[], $decodeUtf8Value=false)
    {
        foreach ($fields as $key => $value) {
            $value = ($decodeUtf8Value)? utf8_decode($value) : $value;

            if (in_array($key, $fieldsLike)) {
                $fields_like [$key] = wrapperAndSlashes(wrapperAndSlashes($value, '%'));
            } else {
                $fields_equal [$key] = wrapperAndSlashes($value);
            }
        }

        return ['like' => $fields_like, 'equal' => $fields_equal];
    }

    public function buildWhereInstruction($fields)
    {
        $fieldsToWhere = [];
        array_walk(
            $fields,
            function ($item, $key) use (&$fieldsToWhere) {
                if ($key == 'equal') {
                    $key = ' = ';
                }
                $fieldsToWhere = array_merge($fieldsToWhere, KeyValueToString($item, $key) );
            }
        );
        return $fieldsToWhere;
    }

    public function delete(string $table, string $where)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $where;

        return $this->executeStatment($sql);
    }
}
