<?php
declare(strict_types=1);

namespace App\SharedKernel\Application\Bus;

use App\SharedKernel\Application\Event\Event;

interface EventBus
{
    public function dispatch(Event $event): void;
}
