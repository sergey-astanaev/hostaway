<?php

namespace Hostaway\Repository\PhoneBook;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Hostaway\DTO\PhoneBook as PhoneBookDTO;
use Hostaway\Entity\PhoneBook;
use Hostaway\Exception\NotFoundException;

class DatabaseStorage implements RepositoryInterface
{

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritdoc
     */
    public function getListByFilter(?string $filter): array
    {
        return $filter === null
            ? $this->repository->findAll()
            : $this->findByFirstName($filter);
    }

    /**
     * @param string $filter
     *
     * @return array
     */
    private function findByFirstName(string $filter): array
    {
        return $this->repository->createQueryBuilder('pb')
            ->andWhere('pb.firstName LIKE :firstName')
            ->setParameter('firstName', $filter . '%')
            ->getQuery()
            ->getResult();
    }

    /**
     * @inheritdoc
     */
    public function getItemById(int $id): PhoneBook
    {
        $phoneBookItem = $this->repository->find($id);

        if ($phoneBookItem === null) {
            throw new NotFoundException();
        }

        return $phoneBookItem;
    }

    /**
     * @inheritdoc
     */
    public function insertItem(PhoneBookDTO $phoneBookDTO): PhoneBook
    {
        $phoneBook = new PhoneBook();

        $this->assemblePhoneBook($phoneBookDTO, $phoneBook);

        $phoneBook->setInsertedOn(new \DateTime());
        $phoneBook->setUpdatedOn(new \DateTime());

        $this->entityManager->persist($phoneBook);

        $this->entityManager->flush($phoneBook);

        return $phoneBook;
    }

    /**
     * @inheritdoc
     */
    public function updateItem(PhoneBookDTO $phoneBookDTO, PhoneBook $phoneBook): void
    {
        $this->assemblePhoneBook($phoneBookDTO, $phoneBook);

        $phoneBook->setUpdatedOn(new \DateTime());

        $this->entityManager->flush($phoneBook);
    }

    /**
     * @inheritdoc
     */
    public function removeItem(PhoneBook $phoneBook): void
    {
        $this->entityManager->remove($phoneBook);

        $this->entityManager->flush();
    }

    /**
     * @inheritdoc
     */
    public function assemblePhoneBookDTO(PhoneBook $phoneBook, PhoneBookDTO $phoneBookDTO)
    {
        $phoneBookDTO->setId($phoneBook->getId());
        $phoneBookDTO->setFirstName($phoneBook->getFirstName());
        $phoneBookDTO->setLastName($phoneBook->getLastName());
        $phoneBookDTO->setPhone($phoneBook->getPhone());
        $phoneBookDTO->setCountryCode($phoneBook->getCountryCode());
        $phoneBookDTO->setTimezone($phoneBook->getTimezone());
    }

    /**
     * @param PhoneBookDTO $phoneBookDTO
     * @param PhoneBook $phoneBook
     */
    private function assemblePhoneBook(PhoneBookDTO $phoneBookDTO, PhoneBook $phoneBook)
    {
        $phoneBook->setFirstName($phoneBookDTO->getFirstName());
        $phoneBook->setLastName($phoneBookDTO->getLastName());
        $phoneBook->setPhone($phoneBookDTO->getPhone());
        $phoneBook->setCountryCode($phoneBookDTO->getCountryCode());
        $phoneBook->setTimezone($phoneBookDTO->getTimezone());
    }
}