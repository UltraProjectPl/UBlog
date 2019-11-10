<?php
declare(strict_types=1);

namespace App\User\Application\Command;

use App\SharedKernel\Application\Bus\CommandHandlerInterface;

final class CreateUserHandler implements CommandHandlerInterface
{
    public function __invoke(CreateUser $command)
    {
    }
}
