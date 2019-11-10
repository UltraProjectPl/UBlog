<?php
declare(strict_types=1);

namespace App\User\Application\Command;

use App\SharedKernel\Application\Command\CommandInterface;

final class CreateUser implements CommandInterface
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
