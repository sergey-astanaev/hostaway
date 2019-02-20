<?php

namespace Hostaway\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstrainsTimezone extends Constraint
{
    public $message = 'Unexpected timezone {{ timezone }}';
}