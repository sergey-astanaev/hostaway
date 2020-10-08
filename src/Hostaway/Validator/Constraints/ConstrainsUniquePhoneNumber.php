<?php

namespace Hostaway\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstrainsUniquePhoneNumber extends Constraint
{
    public $message = 'Phone number {{ phone }} already exists';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}