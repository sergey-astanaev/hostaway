<?php

namespace Hostaway\Service\Response\JSON;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RestfulResponse
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function successful(array $data)
    {
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function internalError(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function badRequest(array $data): JsonResponse
    {
        return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @return JsonResponse
     */
    public function notFound(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    /**
     * @return JsonResponse
     */
    public function noContent(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    public function created(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}