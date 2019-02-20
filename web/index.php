<?php

$containerBuilder = require '../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;

try {
    $request = Request::createFromGlobals();

    $kernel = $containerBuilder->get('http.kernel');

    $response = $kernel->handle($request);
} catch (\Throwable $exception) {
    echo $exception->getMessage().$exception->getTraceAsString(); exit();
}


$response->send();

$kernel->terminate($request, $response);