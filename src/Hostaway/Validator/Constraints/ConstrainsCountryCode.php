<?php

namespace Hostaway\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstrainsCountryCode extends Constraint
{
    public $message = 'Unexpected country code {{ code }}';
}