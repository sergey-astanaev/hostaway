<?php

namespace Hostaway\Service\RequestHandler\PhoneBook;

use Hostaway\Exception\NotFoundException;
use Hostaway\Repository\PhoneBook\RepositoryInterface;
use Hostaway\Service\Response\JSON\RestfulResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteItemHandler
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var RestfulResponse
     */
    private $response;

    public function __construct(RepositoryInterface $repository, RestfulResponse $response)
    {
        $this->repository = $repository;
        $this->response = $response;
    }

    /**
     * @param int $phoneBookId
     *
     * @return Response
     */
    public function handle(int $phoneBookId): Response
    {
        try {
            $phoneBook = $this->repository->getItemById($phoneBookId);

            $this->repository->removeItem($phoneBook);

            return $this->response->noContent();
        } catch (NotFoundException $e) {
            return $this->response->notFound();
        } catch (\Throwable $e) {
            return $this->response->internalError();
        }
    }
}