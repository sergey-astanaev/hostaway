<?php

namespace Hostaway\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="phone-book")
 */
class PhoneBookController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     *
     * @Route(path="/", methods={"GET"})
     */
    public function getList(Request $request): Response
    {
        return $this->getContainer()
            ->get('service.request_handler.phone_book.get_list_handler')
            ->handle($request);
    }

    /**
     * @param Request $request
     * @param int $phone
     *
     * @return Response
     *
     * @throws \Exception
     *
     * @Route(path="/{phone}", methods={"GET"})
     */
    public function getItem(Request $request, int $phone): Response
    {
        return $this->getContainer()
            ->get('service.request_handler.phone_book.get_item_handler')
            ->handle($phone);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws \Exception
     *
     * @Route(path="/", methods={"POST"})
     */
    public function insertItem(Request $request): JsonResponse
    {
        return $this->getContainer()
            ->get('service.request_handler.phone_book.post_handler')
            ->handle($request);
    }

    /**
     * @param Request $request
     * @param int $phone
     *
     * @return JsonResponse
     *
     * @throws \Exception
     *
     * @Route(path="/{phone}", methods={"PUT"})
     */
    public function updateItem(Request $request, int $phone): JsonResponse
    {
        return $this->getContainer()
            ->get('service.request_handler.phone_book.put_handler')
            ->handle($request, $phone);
    }

    /**
     * @param Request $request
     * @param int $phone
     *
     * @return JsonResponse
     *
     * @throws \Exception
     *
     * @Route(path="/{phone}", methods={"DELETE"})
     */
    public function deleteItem(Request $request, int $phone): JsonResponse
    {
        return $this->getContainer()
            ->get('service.request_handler.phone_book.delete_item_handler')
            ->handle($phone);
    }
}