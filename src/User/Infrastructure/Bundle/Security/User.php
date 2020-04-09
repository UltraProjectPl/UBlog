<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\User\Infrastructure\Bundle\Security;

use App\User\Domain\User as DomainUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Serializable;

final class User implements UserInterface
{
    public const ROLE = 'ROLE_USER';

    private DomainUser $user;

    private string $username;

    private string $password;

//    private string $token;

    public function __construct(DomainUser $user) //, string $token)
    {
        $this->user = $user;
        $this->username = $user->getEmail();
        $this->password = $user->getPassword();
//        $this->refreshToken($token);
    }

    public function getUsername(): string
    {
        return $this->username ?? $this->user->getEmail();
    }

    public function getPassword(): string
    {
        return $this->password ?? $this->user->getPassword();
    }

//    public function getToken(): string
//    {
//        return $this->token;
//    }

//    public function refreshToken(string $token): void
//    {
//        $this->token = $token;
//    }

    public function getRoles(): array
    {
        return [self::ROLE];
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials():void
    {
    }
}
