<?php
declare(strict_types=1);

namespace App\User\Domain;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User
{
    private UuidInterface $id;

    private string $email;

    private string $nick;

    private ?DateTimeImmutable $birthDate;

    private string $password;

    private ?string $token = null;

    public function __construct(
        string $email,
        string $password,
        string $nick,
        ?DateTimeImmutable $birthDate = null
    ) {
        $this->id = Uuid::uuid4();
        $this->email = $email;
        $this->changePassword($password);
        $this->changeNick($nick);
        $this->changeBirthDate($birthDate);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNick(): string
    {
        return $this->nick;
    }

    public function getBirthDate(): ?DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function changePassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function changeNick(string $nick): void
    {
        $this->nick = $nick;
    }

    public function changeBirthDate(?DateTimeImmutable $birthDate = null): void
    {
        $this->birthDate = $birthDate;
    }

    public function verifyPassword(string $hashedString): bool
    {
        return password_verify($this->password, $hashedString);
    }
}
