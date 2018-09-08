<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class ProjectServiceContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    public function __construct()
    {
        $this->services = array();
        $this->normalizedIds = array(
            'app\\services\\emailservice' => 'App\\Services\\EmailService',
            'app\\services\\formattingservice' => 'App\\Services\\FormattingService',
            'app\\services\\orderservice' => 'App\\Services\\OrderService',
            'app\\services\\projectservice' => 'App\\Services\\ProjectService',
        );
        $this->methodMap = array(
            'App\\Services\\EmailService' => 'getEmailServiceService',
            'App\\Services\\FormattingService' => 'getFormattingServiceService',
            'App\\Services\\OrderService' => 'getOrderServiceService',
            'App\\Services\\ProjectService' => 'getProjectServiceService',
        );

        $this->aliases = array();
    }

    public function getRemovedIds()
    {
        return array(
            'Psr\\Container\\ContainerInterface' => true,
            'Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
        );
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function isFrozen()
    {
        @trigger_error(sprintf('The %s() method is deprecated since Symfony 3.3 and will be removed in 4.0. Use the isCompiled() method instead.', __METHOD__), E_USER_DEPRECATED);

        return true;
    }

    /**
     * Gets the public 'App\Services\EmailService' shared autowired service.
     *
     * @return \App\Services\EmailService
     */
    protected function getEmailServiceService()
    {
        return $this->services['App\Services\EmailService'] = new \App\Services\EmailService();
    }

    /**
     * Gets the public 'App\Services\FormattingService' shared autowired service.
     *
     * @return \App\Services\FormattingService
     */
    protected function getFormattingServiceService()
    {
        return $this->services['App\Services\FormattingService'] = new \App\Services\FormattingService();
    }

    /**
     * Gets the public 'App\Services\OrderService' shared autowired service.
     *
     * @return \App\Services\OrderService
     */
    protected function getOrderServiceService()
    {
        return $this->services['App\Services\OrderService'] = new \App\Services\OrderService(${($_ = isset($this->services['App\Services\EmailService']) ? $this->services['App\Services\EmailService'] : $this->services['App\Services\EmailService'] = new \App\Services\EmailService()) && false ?: '_'}, ${($_ = isset($this->services['App\Services\FormattingService']) ? $this->services['App\Services\FormattingService'] : $this->services['App\Services\FormattingService'] = new \App\Services\FormattingService()) && false ?: '_'});
    }

    /**
     * Gets the public 'App\Services\ProjectService' shared autowired service.
     *
     * @return \App\Services\ProjectService
     */
    protected function getProjectServiceService()
    {
        return $this->services['App\Services\ProjectService'] = new \App\Services\ProjectService();
    }
}
