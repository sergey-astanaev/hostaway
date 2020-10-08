<?php

namespace Hostaway\Service\RequestHandler\PhoneBook;

use Hostaway\DTO\PhoneBook;
use Hostaway\Exception\NotFoundException;
use Hostaway\Repository\PhoneBook\RepositoryInterface;
use Hostaway\Service\Response\JSON\RestfulResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

class GetItemHandler
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var RestfulResponse
     */
    private $response;

    public function __construct(RepositoryInterface $repository, Serializer $serializer, RestfulResponse $response)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
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
            $phoneBookDTO = new PhoneBook();
            $this->repository->assemblePhoneBookDTO($phoneBook, $phoneBookDTO);

            return $this->response->successful(
                $this->serializer->normalize($phoneBookDTO)
            );
        } catch (NotFoundException $e) {
            return $this->response->notFound();
        } catch (\Throwable $e) {
            return $this->response->internalError();
        }
    }
}