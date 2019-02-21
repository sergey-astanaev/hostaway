<?php

namespace Hostaway\Validator\Constraints;

use Hostaway\Service\Connector\HostawayConnector;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstrainsCountryCodeValidator extends ConstraintValidator
{
    /**
     * @var HostawayConnector
     */
    private $connector;

    public function __construct(HostawayConnector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if ($value === null || $value === '') {
            return;
        }

        $countryCodeList = $this->connector->getCountryCodeList();
        if (!array_key_exists($value, $countryCodeList)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ code }}', $value)
                ->addViolation();
        }
    }
}