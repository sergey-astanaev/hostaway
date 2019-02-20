<?php

namespace Hostaway\Service\AnnotationLoader;

use Symfony\Component\Routing\Loader\AnnotationClassLoader;
use Symfony\Component\Routing\Route;

class AnnotationRouteControllerLoader extends AnnotationClassLoader
{
    /**
     * @inheritdoc
     */
    protected function configureRoute(Route $route, \ReflectionClass $class, \ReflectionMethod $method, $annot)
    {
        $route->setDefault('_controller', $class->getName().'::'.$method->getName());
    }
}