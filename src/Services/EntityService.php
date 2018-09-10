<?php

namespace App\Services;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Proxy\ProxyFactory;
use Doctrine\ORM\Tools\Setup;

class EntityService
{
    /**
     * @var EntityManager $entityManager
     */
    protected $entityManager;

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function __construct()
    {
        $paths = [
            __DIR__
        ];

        $isDevMode = true;
        $proxyDir = getenv('APP_PATH') . '/var/doctrineproxy';

        $config = Setup::createAnnotationMetadataConfiguration(
            $paths,
            $isDevMode,
            $proxyDir,
            $this->getAnnotationCache(),
            false
        );

        $config->setAutoGenerateProxyClasses(ProxyFactory::AUTOGENERATE_FILE_NOT_EXISTS);

        $config->setResultCacheImpl($this->getAnnotationCache());

        $databaseParams = $this->getDatabaseConfiguration();
        $this->entityManager = EntityManager::create($databaseParams, $config);

        AnnotationRegistry::registerLoader('class_exists');
    }

    /**
     * @return array
     */
    protected function getDatabaseConfiguration()
    {
        return [
            'host' => getenv('DATABASE_HOST'),
            'driver' => 'pdo_mysql',
            'user' => getenv('DATABASE_USERNAME'),
            'password' => getenv('DATABASE_PASSWORD'),
            'dbname' => getenv('DATABASE_NAME'),
            'charset' => getenv('DATABASE_CHARSET')
        ];
    }

    /**
     * @return ArrayCache
     * @throws \Exception
     */
    public function getAnnotationCache()
    {
        return new ArrayCache();
    }
}