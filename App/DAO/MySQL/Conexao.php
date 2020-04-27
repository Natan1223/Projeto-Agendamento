<?php

namespace App\DAO\MySQL;

abstract class Conexao
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        $host = getenv('DOEVIDAS_HOST');
        $port = getenv('DOEVIDAS_PORT');
        $user = getenv('DOEVIDAS_USER');
        $pass = getenv('DOEVIDAS_PASSWORD');
        $dbname = getenv('DOEVIDAS_DBNAME');

        $dsn = "mysql:host={$host};dbname={$dbname};charset=UTF8;port={$port}";
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );

    }
}