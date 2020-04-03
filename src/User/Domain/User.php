<?php
declare(strict_types=1);

namespace App\User\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class User
{
    private UuidInterface $id;

    private string $email;

    private string $password;

    private ?string $token = null;

    public function __construct(
        string $email,
        string $password
    ) {
        $this->id = Uuid::uuid4();
        $this->email = $email;
        $this->changePassword($password);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
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

    public function verifyPassword(string $hashedString): bool
    {
        return password_verify($this->password, $hashedString);
    }
}
