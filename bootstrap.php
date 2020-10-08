<?php

$classLoader = require 'vendor/autoload.php';

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

AnnotationRegistry::registerLoader([$classLoader, 'loadClass']);

$containerBuilder = new ContainerBuilder();

$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/config'));
$loader->load('services.yml');

$containerBuilder->setParameter('project.dir', __DIR__);

return $containerBuilder;