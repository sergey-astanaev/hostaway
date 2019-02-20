<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$containerBuilder = require_once 'bootstrap.php';

$entityManager = $containerBuilder->get('doctrine.entity_manager');


return ConsoleRunner::createHelperSet($entityManager);