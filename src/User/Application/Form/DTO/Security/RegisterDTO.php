<?php
declare(strict_types=1);

namespace App\User\Application\Form\DTO\Security;

use App\User\Application\Command\CreateUser;

final class RegisterDTO
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    public function toCommand(): CreateUser
    {
        return new CreateUser(
            $this->email,
            $this->password
        );
    }
}
