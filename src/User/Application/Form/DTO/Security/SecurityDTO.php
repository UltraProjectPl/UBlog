<?php
declare(strict_types=1);

namespace App\User\Application\Form\DTO\Security;

final class SecurityDTO
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var bool
     */
    public $rememberMe;
}
