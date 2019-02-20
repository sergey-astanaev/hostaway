<?php

namespace Hostaway\Repository\PhoneBook;


use Hostaway\Entity\PhoneBook;
use Hostaway\DTO\PhoneBook as PhoneBookDTO;
use Hostaway\Exception\NotFoundException;

interface RepositoryInterface
{
    /**
     * @param string|null $filter
     *
     * @return PhoneBook[]|[]
     */
    public function getListByFilter(?string $filter): array;

    /**
     * @param int $id
     *
     * @throws NotFoundException
     *
     * @return PhoneBook
     */
    public function getItemById(int $id): PhoneBook;

    /**
     * @param PhoneBookDTO $phoneBookDTO
     * @return PhoneBook
     */
    public function insertItem(PhoneBookDTO $phoneBookDTO): PhoneBook;

    /**
     * @param PhoneBookDTO $phoneBookDTO
     * @param PhoneBook $phoneBook
     */
    public function updateItem(PhoneBookDTO $phoneBookDTO, PhoneBook $phoneBook): void;

    /**
     * @param PhoneBook $phoneBook
     */
    public function removeItem(PhoneBook $phoneBook): void;

    /**
     * @param PhoneBook $phoneBook
     * @param PhoneBookDTO $phoneBookDTO
     */
    public function assemblePhoneBookDTO(PhoneBook $phoneBook, PhoneBookDTO $phoneBookDTO);
}