<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Messenger;

use App\SharedKernel\Application\Bus\NotificationBus as NotificationBusInterface;
use App\SharedKernel\Application\Notification\Notification;

final class NotificationBus extends Bus implements NotificationBusInterface
{
    /**
     * @var Notification[]
     */
    private $notification = [];

    public function send(Notification $notification): void
    {
        $this->notification[] = $notification;
    }

    public function release(): void
    {
        array_walk($this->notification, function (Notification $notification): void {
            $this->bus->dispatch($notification);
        });

        $this->reset();
    }

    public function reset(): void
    {
        $this->notification = [];
    }
}
