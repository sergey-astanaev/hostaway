<?php

namespace Hostaway\Service\RequestHandler\PhoneBook;

use Hostaway\Entity\PhoneBook;
use Hostaway\DTO\PhoneBook as PhoneBookDTO;
use Hostaway\Repository\PhoneBook\RepositoryInterface;
use Hostaway\Service\Response\JSON\RestfulResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

class GetListHandler
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
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $filter = $request->get('first_name');
        try {
            $phoneBookList = $this->repository->getListByFilter($filter);

            return $this->response
                ->successful(
                    $this->serializer->normalize(
                        array_map(
                            function (PhoneBook $phoneBook): PhoneBookDTO {
                                $phoneBookDTO = new PhoneBookDTO();
                                $this->repository->assemblePhoneBookDTO($phoneBook, $phoneBookDTO);

                                return $phoneBookDTO;
                            },
                            $phoneBookList
                        )
                    )
                );
        } catch (\Throwable $e) {
            return $this->response->internalError();
        }
    }
}