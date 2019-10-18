<?php


namespace viking\core\database;

use PDO;

use PDOException;

/**
 * Class with singleton pattern.
 * 
 */
class connection
{

    public static $connection;

    private function __construct() 
    {
        // singleton 
    }

    public static function getConnetion($config)
    {
        if (!isset(self::$connection)) {
            self::$connection = self::make($config);
        }

        return self::$connection;
    }

    /**
     * Create a database connection.
     *
     * @param [array] $config
     * @return PDO
     */
    public static function make($config)
    {
        try {
            return new PDO(
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}

