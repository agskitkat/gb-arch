<?php


namespace Framework\Command;


use Kernel;

class registerRoutesCommand implements Command
{

    /**
     * @var Kernel
     */
    private $context;

    public function __construct(Kernel $context)
    {
        $this->context = $context;
    }

    function execute()
    {
        $this->context->routeCollection = require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.php';
        $this->context->containerBuilder->set('route_collection', $this->context->routeCollection);
    }
}