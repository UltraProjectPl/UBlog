<?php
declare(strict_types=1);

namespace App\User\Application\Command;

use App\SharedKernel\Application\Command\CommandInterface;
use App\User\Domain\User;

class LoginUser implements CommandInterface
{
    private User $user;

    private bool $rememberMe;

    private ?string $ip;

    public function __construct(User $user, bool $rememberMe = false, ?string $ip = null)
    {
        $this->user = $user;
        $this->rememberMe = $rememberMe;
        $this->ip = $ip;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getRememberMe(): bool
    {
        return $this->rememberMe;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }
}
