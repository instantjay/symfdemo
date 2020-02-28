<?php

namespace App\System;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Handles bootstrapping our application.
 *
 * Class Application
 * @package App\System
 */
class Application
{
    protected $serviceContainer;

    protected static $instance;

    /**
     * Singleton pattern since we only ever want one instance of the application.
     *
     * @return Application
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @throws \Exception
     * @returns bool
     */
    protected function loadEnvironmentVariables()
    {
        $dotenv = new Dotenv();
        $dotenv->load(dirname(__DIR__) . '/.env');

        return true;
    }

    /**
     * Compile our container based on services.yaml and store it to file.
     *
     * @param string $targetPath
     * @return bool|string
     * @throws \Exception
     */
    protected function compileServiceContainer($targetPath)
    {
        $containerBuilder = new ContainerBuilder();

        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.yaml');

        $this->serviceContainer = $containerBuilder;

        $containerBuilder->compile();
        $dumper = new PhpDumper($containerBuilder);

        if (!is_file($targetPath)) {
            $fs = new Filesystem();
            $fs->mkdir(dirname($targetPath));
        }

        file_put_contents($targetPath, $dumper->dump());

        return realpath($targetPath);
    }

    /**
     * Gets the service container. If a cached container file does not exist, one will be created.
     *
     * @return \ProjectServiceContainer
     * @throws \Exception
     */
    public function getServiceContainer()
    {
        //
        if ($this->serviceContainer) {
            return $this->serviceContainer;
        }

        // Build and compile container
        $cachedContainerPath = __DIR__ . '/../var/container.php';

        if (!file_exists($cachedContainerPath)) {
            $cachedContainerPath = $this->compileServiceContainer($cachedContainerPath);
        }

        require_once($cachedContainerPath);
        $this->serviceContainer = new \ProjectServiceContainer(); // This name is made up when compiling the container.

        //
        return $this->serviceContainer;
    }
}
