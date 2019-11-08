<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;

abstract class Bus
{
    /**
     * @var MessageBusInterface
     */
    protected $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }
}
