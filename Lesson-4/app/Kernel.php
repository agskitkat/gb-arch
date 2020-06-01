<?php

declare(strict_types = 1);

use Framework\Command\Invoker;
use Framework\Command\processCommand;
use Framework\Command\registerConfigsCommand;
use Framework\Command\registerRoutesCommand;
use Framework\Registry;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Kernel
{
    /**
     * @var RouteCollection
     */
    public $routeCollection;

    /**
     * @var ContainerBuilder
     */
    public $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        // Реализация комманд
        $invoker = new Invoker();
        $invoker->setCommand(new registerConfigsCommand($this));
        $invoker->setCommand(new registerRoutesCommand($this));
        $invoker->executeAll();

        return $invoker->executeNowAndReturn(new processCommand($this, $request));
    }
}
