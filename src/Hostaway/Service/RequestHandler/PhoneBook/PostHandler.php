<?php

namespace Hostaway\Service\RequestHandler\PhoneBook;

use Hostaway\DTO\PhoneBook;
use Hostaway\Repository\PhoneBook\RepositoryInterface;
use Hostaway\Service\Response\JSON\RestfulResponse;
use Hostaway\Service\Serializer\SerializerInterface;
use Hostaway\Service\Validator\ValidatorAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostHandler
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorAdapter
     */
    private $validator;

    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var RestfulResponse
     */
    private $response;

    public function __construct(SerializerInterface $serializer, ValidatorAdapter $validator, RepositoryInterface $repository, RestfulResponse $response)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->repository = $repository;
        $this->response = $response;

    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response
    {
        try {
            $content = $request->getContent();

            /** @var PhoneBook $phoneItemDTO */
            $phoneItemDTO = $this->serializer->deserialize($content, PhoneBook::class);


            /** @var string[] $errors */
            $errors = $this->validator->validate($phoneItemDTO);

            if (count($errors) > 0) {
                return $this->response->badRequest(
                    [
                        'errors' => $errors
                    ]
                );
            } else {
                $this->repository->insertItem($phoneItemDTO);

                return $this->response->created();
            }
        } catch (\Throwable $e) {
            return $this->response->internalError();
        }
    }
}