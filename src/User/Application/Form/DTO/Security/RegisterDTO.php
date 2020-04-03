<?php
declare(strict_types=1);

namespace App\User\Application\Form\DTO\Security;

use App\User\Application\Command\CreateUser;

final class RegisterDTO
{
    public ?string $email = null;

    public ?string $password = null;

    public function toCommand(): CreateUser
    {
        return new CreateUser(
            $this->email,
            $this->password
        );
    }
}
