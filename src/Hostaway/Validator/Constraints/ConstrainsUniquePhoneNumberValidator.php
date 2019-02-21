<?php

namespace Hostaway\Validator\Constraints;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstrainsUniquePhoneNumberValidator extends ConstraintValidator
{
    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if ($value === null) {
            return;
        }

        $phoneBook = $this->repository->findOneBy(['phone' => $value->getPhone()]);
        if ($phoneBook !== null && $value->getId() !== $phoneBook->getId()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ phone }}', $value->getPhone())
                ->addViolation();
        }
    }
}