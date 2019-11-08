<?php
declare(strict_types=1);

namespace App\SharedKernel\Application\Bus;

use App\SharedKernel\Application\Notification\Notification;

interface NotificationBus
{
    public function send(Notification $notification): void;
}
