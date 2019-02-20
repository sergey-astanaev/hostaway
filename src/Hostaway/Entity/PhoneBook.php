<?php

namespace Hostaway\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="phone_book",
 *     indexes={@ORM\Index(name="first_name_idx", columns={"first_name"})}
 * )
 * @ORM\Entity()
 */
class PhoneBook
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue("AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, unique=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=2)
     */
    private $countryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=50)
     */
    private $timezone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inserted_on", type="datetime")
     */
    private $insertedOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_on", type="datetime")
     */
    private $updatedOn;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    /**
     * @return \DateTime
     */
    public function getInsertedOn(): \DateTime
    {
        return $this->insertedOn;
    }

    /**
     * @param \DateTime $insertedOn
     */
    public function setInsertedOn(\DateTime $insertedOn): void
    {
        $this->insertedOn = $insertedOn;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedOn(): \DateTime
    {
        return $this->updatedOn;
    }

    /**
     * @param \DateTime $updatedOn
     */
    public function setUpdatedOn(\DateTime $updatedOn): void
    {
        $this->updatedOn = $updatedOn;
    }
}