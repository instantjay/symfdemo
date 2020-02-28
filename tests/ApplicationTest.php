<?php

namespace App\Tests;

use App\System\Application;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testGetInstance()
    {
        $app = Application::getInstance();

        $serviceContainer = $app->getServiceContainer();

        $expectedContainerFilePath = dirname(__DIR__) . '/var/container.php';
        $this->assertFileExists($expectedContainerFilePath);
    }
}