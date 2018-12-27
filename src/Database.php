<?php
namespace Itb;

class Database
{
    const DB_NAME = 'cursedpr_cursed'; //give database a name
    const DB_USER = 'root'; //use database username
    const DB_PASS = 'root';//use database password - remember my personal password at home is PASS not pass
    const DB_HOST = 'localhost:3306'; //use database port

    private $connection; //create connection variable

    public function __construct()
    {
        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST;

        try {
            $this->connection = new \PDO($dsn, self::DB_USER, self::DB_PASS);
        } catch (\Exception $e) {
            print '<pre>';
            var_dump($e);
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}