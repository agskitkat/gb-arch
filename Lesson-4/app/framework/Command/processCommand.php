<?php


namespace Framework\Command;

use Framework\Registry;
use Kernel;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;

class processCommand implements Command
{

    private $context;
    private $request;

    public function __construct(Kernel $context, Request $request)
    {
        $this->context = $context;
        $this->request = $request;
    }

    function execute()
    {
        $matcher = new UrlMatcher($this->context->routeCollection, new RequestContext());
        $matcher->getContext()->fromRequest($this->request);

        try {
            $this->request->attributes->add($matcher->match($this->request->getPathInfo()));
            $this->request->setSession(new Session());

            $controller = (new ControllerResolver())->getController($this->request);
            $arguments = (new ArgumentResolver())->getArguments($this->request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            return new Response('Page not found. 404', Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            $error = 'Server error occurred. 500';
            if (Registry::getDataConfig('environment') === 'dev') {
                $error .= '<pre>' . $e->getTraceAsString() . '</pre>';
            }

            return new Response($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}