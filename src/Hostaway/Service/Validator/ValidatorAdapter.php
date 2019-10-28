<?php

namespace Hostaway\Service\Validator;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validator\ContextualValidatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorAdapter
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($value, $constraints = null, $groups = null): array
    {
        /** @var ConstraintViolationListInterface $errors */
        $errors = $this->validator->validate($value, $constraints, $groups);

        $errorList = [];
        foreach ($errors as $error) {
            $errorList[] = $error->getMessage();
        }

        return $errorList;
    }

    /**
     * @param $object
     * @param $propertyName
     * @param null $groups
     *
     * @return ConstraintViolationListInterface
     */
    public function validateProperty($object, $propertyName, $groups = null): ConstraintViolationListInterface
    {
        return $this->validator->validateProperty($object, $propertyName, $groups);
    }

    /**
     * @param $objectOrClass
     * @param $propertyName
     * @param $value
     * @param null $groups
     *
     * @return ConstraintViolationListInterface
     */
    public function validatePropertyValue($objectOrClass, $propertyName, $value, $groups = null): ConstraintViolationListInterface
    {
        return $this->validator->validatePropertyValue($objectOrClass, $propertyName, $value, $groups);
    }


    /**
     * @return ContextualValidatorInterface
     */
    public function startContext(): ContextualValidatorInterface
    {
        return $this->validator->startContext();
    }

    /**
     * @param ExecutionContextInterface $context
     *
     * @return ContextualValidatorInterface
     */
    public function inContext(ExecutionContextInterface $context): ContextualValidatorInterface
    {
        return $this->validator->inContext($context);
    }
}