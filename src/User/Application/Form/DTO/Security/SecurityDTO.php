<?php
declare(strict_types=1);

namespace App\User\Application\Form\DTO\Security;

final class SecurityDTO
{
    public ?string $email = null;

    public ?string $password = null;

    public ?bool $rememberMe = null;
}
