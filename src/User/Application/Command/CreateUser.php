<?php
declare(strict_types=1);

namespace App\User\Application\Command;

use App\SharedKernel\Application\Command\CommandInterface;
use DateTimeImmutable;

final class CreateUser implements CommandInterface
{
    private string $email;

    private string $nick;

    private ?DateTimeImmutable $birthDate;

    private string $password;

    public function __construct(string $email, string $password, string $nick, ?DateTimeImmutable $birthDate)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nick = $nick;
        $this->birthDate = $birthDate;
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
}
