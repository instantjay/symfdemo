<?php

namespace App\Services;

class PdoService
{
    protected $pdo;

    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * ORMService constructor.
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function __construct()
    {
        $this->instantiatePdo();
    }

    protected function instantiatePdo()
    {
        $host = getenv('DATABASE_HOST');
        $name = getenv('DATABASE_NAME');
        $username = getenv('DATABASE_USERNAME');
        $password = getenv('DATABASE_PASSWORD');
        $charset = getenv('DATABASE_CHARSET');

        //
        $this->pdo = new \PDO("mysql:host=$host; dbname=$name, $username, $password");
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("SET CHARACTER SET $charset");
    }
}
