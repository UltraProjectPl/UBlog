<?php
declare(strict_types=1);

namespace App\User\Application\Query;

use App\SharedKernel\Application\Query\QueryInterface;

final class SessionByToken implements QueryInterface
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
