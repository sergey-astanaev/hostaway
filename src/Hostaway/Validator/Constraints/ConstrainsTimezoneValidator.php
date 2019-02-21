<?php

namespace Hostaway\Validator\Constraints;

use Hostaway\Service\Connector\HostawayConnector;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstrainsTimezoneValidator extends ConstraintValidator
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

        $timeZoneList = $this->connector->getTimeZoneList();
        if (!array_key_exists($value, $timeZoneList)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ timezone }}', $value)
                ->addViolation();
        }
    }
}