<?php
declare(strict_types=1);

namespace App\User\Domain;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Session
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string|null
     */
    private $token;

    /**
     * @var DateTimeImmutable|null
     */
    private $tokenValidTo;

    /**
     * @var bool
     */
    private $rememberMe;

    /**
     * @var DateTimeImmutable
     */
    private $loginDate;

    /**
     * @var string|null
     */
    private $firstLoginIp;

    /**
     * @varActiveSessionByUserEmailHandler User
     */
    private $user;

    public function __construct(
        User $user,
        bool $rememberMe,
        ?string $firstLoginIp
    ) {
        $this->id = Uuid::uuid4();
        $this->user = $user;
        $this->token = self::createToken();
        $this->loginDate = new DateTimeImmutable();
        $this->rememberMe = $rememberMe;

        if (false === $rememberMe) {
            $this->tokenValidTo = new DateTimeImmutable('+12 hours');
        }

        $this->firstLoginIp = $firstLoginIp;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLoginDate(): DateTimeImmutable
    {
        return $this->loginDate;
    }

    public function getTokenValidTo(): ?DateTimeImmutable
    {
        return $this->tokenValidTo;
    }

    public function getFirstLoginIp(): ?string
    {
        return $this->firstLoginIp;
    }

    public function disable(): self
    {
        $this->token = null;

        $this->rememberMe = false;

        return $this;
    }

    public function isActive(): bool
    {
        if (null === $this->tokenValidTo) {
            return $this->rememberMe;
        }

        return new DateTimeImmutable() > $this->tokenValidTo;
    }

    public function refreshToken(): self
    {
        $this->token = self::createToken();

        if (false === $this->rememberMe) {
            $this->tokenValidTo = new DateTimeImmutable('+12 hours');
        }

        return $this;
    }

    private static function createToken(): string
    {
        return bin2hex(random_bytes(25));
    }
}
