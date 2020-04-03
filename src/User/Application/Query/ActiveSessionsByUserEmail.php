<?php
declare(strict_types=1);

namespace App\User\Application\Query;

use App\SharedKernel\Application\Query\QueryInterface;

final class ActiveSessionsByUserEmail implements QueryInterface
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
