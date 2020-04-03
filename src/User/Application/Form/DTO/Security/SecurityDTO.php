<?php
declare(strict_types=1);

namespace App\User\Application\Form\DTO\Security;

final class SecurityDTO
{
    public string $email;

    public string $password;

    public bool $rememberMe;
}
