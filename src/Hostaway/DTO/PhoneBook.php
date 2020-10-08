<?php

namespace Hostaway\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use Hostaway\Validator\Constraints as HostawayAssert;

/**
 * @HostawayAssert\ConstrainsUniquePhoneNumber
 */
class PhoneBook
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @Assert\Length(max="255")
     */
    private $lastName;

    /**
     * @var string
     *
     * @Assert\Regex(pattern="/^\+\d{10,15}$/")
     */
    private $phone;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @HostawayAssert\ConstrainsCountryCode()
     */
    private $countryCode;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @HostawayAssert\ConstrainsTimezone()
     */
    private $timezone;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }


    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }
}