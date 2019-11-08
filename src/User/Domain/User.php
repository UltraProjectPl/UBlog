<?php
declare(strict_types=1);

namespace App\User\Domain;

use Ramsey\Uuid\UuidInterface;

final class User
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $token;

    public function __construct(
        UuidInterface $id,
        string $email,
        string $password,
        string $token
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
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

    public function getToken(): string
    {
        return $this->token;
    }
}
