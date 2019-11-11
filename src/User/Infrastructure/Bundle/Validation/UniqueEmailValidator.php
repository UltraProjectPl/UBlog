<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Bundle\Validation;

use App\SharedKernel\Application\Bus\QueryBusInterface;
use App\User\Application\Query\UserByEmail;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueEmailValidator extends ConstraintValidator
{
    /**
     * @var QueryBusInterface
     */
    private $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof UniqueEmail) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\UniqueEmail');
        }

        $user = $this->queryBus->query(new UserByEmail($value));

        if (null !== $user) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
