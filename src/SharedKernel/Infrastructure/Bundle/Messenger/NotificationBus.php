<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Messenger;

use App\SharedKernel\Application\Bus\NotificationBusInterface;
use App\SharedKernel\Application\Notification\NotificationInterface;

final class NotificationBus extends Bus implements NotificationBusInterface
{
    /**
     * @var NotificationInterface[]
     */
    private $notification = [];

    public function send(NotificationInterface $notification): void
    {
        $this->notification[] = $notification;
    }

    public function release(): void
    {
        array_walk($this->notification, function (NotificationInterface $notification): void {
            $this->bus->dispatch($notification);
        });

        $this->reset();
    }

    public function reset(): void
    {
        $this->notification = [];
    }
}
