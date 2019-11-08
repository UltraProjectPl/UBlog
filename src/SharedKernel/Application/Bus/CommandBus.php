<?php
declare(strict_types=1);

namespace App\SharedKernel\Application\Bus;

use App\SharedKernel\Application\Command\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
