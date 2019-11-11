<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Bundle\Validation;

use Symfony\Component\Validator\Constraint;

class UniqueEmail extends Constraint
{
    public $message = 'Email must be unique';
}
