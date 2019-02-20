<?php

namespace Hostaway\Service\Controller;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;

class ControllerContainerAwareResolver implements ControllerResolverInterface
{
    /**
     * @var ControllerResolverInterface
     */
    private $controllerResolver;

    /**
     * @var ContainerBuilder
     */
    private $containerBuilder;

    public function __construct(ControllerResolverInterface $controllerResolver, ContainerBuilder $containerBuilder)
    {
        $this->controllerResolver = $controllerResolver;
        $this->containerBuilder = $containerBuilder;
    }

    /**
     * @inheritdoc
     */
    public function getController(Request $request)
    {
        $controller = $this->controllerResolver->getController($request);
        if ($controller === false) {
            return $controller;
        }

        if ($controller[0] instanceof ContainerAwareInterface) {
            $controller[0]->setContainer($this->containerBuilder);
        }

        return $controller;
    }
}