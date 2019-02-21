<?php

$containerBuilder = require '../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

try {
    $request = Request::createFromGlobals();

    $kernel = $containerBuilder->get('http.kernel');

    $response = $kernel->handle($request);
} catch (NotFoundHttpException $exception) {
    $response = new Response('', Response::HTTP_NOT_FOUND);
} catch (MethodNotAllowedHttpException $exception) {
    $response = new Response('', Response::HTTP_BAD_REQUEST);
} catch (\Throwable $exception) {
    $response = new Response('', Response::HTTP_INTERNAL_SERVER_ERROR);
}


$response->send();

$kernel->terminate($request, $response);