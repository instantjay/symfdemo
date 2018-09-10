<?php

namespace App\Nosh\Models;

use App\Services\PdoService;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class AbstractModel
{
    protected $pdo;

    abstract public function getTableName();

    public function __construct(ContainerBuilder $container)
    {
        $pdoService = $container->get(PdoService::class);
        $this->pdo = $pdoService->getPdo();
    }

    /**
     * @param $entryId
     * @return array
     */
    public function find($entryId)
    {
        $miner = new \Miner($this->pdo);
        $miner->select('*');
        $miner->from($this->getTableName());
        $miner->limit(1);

        $statement = $miner->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param array $params
     * @return array
     */
    public function findBy($params = [])
    {
        $miner = new \Miner($this->pdo);
        $miner->select('*');
        $miner->from($this->getTableName());

        foreach ($params as $column => $value) {
            $miner->andWhere($column, $value);
        }

        $statement = $miner->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $miner = new \Miner($this->pdo);
        $miner->select('*');
        $miner->from($this->getTableName());

        $statement = $miner->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}