<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Messenger;

use App\SharedKernel\Application\Bus\EventBus as EventBusInterface;
use App\SharedKernel\Application\Event\Event;

final class EventBus extends Bus implements EventBusInterface
{
    public function dispatch(Event $event): void
    {
        $this->bus->dispatch($event);
    }
}
