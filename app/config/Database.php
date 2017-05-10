<?php
namespace App\Config;

class Database {
    /*
     * Configuration and setup mysql database
     */
    private static $driver     = 'pdo_mysql';
    private static $host       = '127.0.0.1';
    private static $dbname     = 'social_sweethearts';
    private static $username   = 'root';
    private static $password   = '';
    private static $connection;

    /**
     * @return array
     */
    public static function getInstance() {
        if (self::$connection === null) {
            self::$connection = array(
                    'driver'   => self::$driver,
                    'host'     => self::$host,
                    'dbname'   => self::$dbname,
                    'user'     => self::$username,
                    'password' => self::$password,
                );
        }
        return self::$connection;
    }

    protected function __construct() {
        //
    }

    protected function __clone() {
        //
    }
}
