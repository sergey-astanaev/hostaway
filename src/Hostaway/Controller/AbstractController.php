<?php

namespace Hostaway\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractController implements ContainerAwareInterface
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerBuilder
     */
    protected function getContainer(): ContainerBuilder
    {
        return $this->container;
    }
}