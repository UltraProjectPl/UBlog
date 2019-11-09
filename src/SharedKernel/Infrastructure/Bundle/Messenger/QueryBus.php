<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Messenger;

use App\SharedKernel\Application\Bus\QueryBusInterface;
use App\SharedKernel\Application\Query\QueryInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class QueryBus extends Bus implements QueryBusInterface
{

    public function query(QueryInterface $query)
    {
        /** @var Envelope $envelope */
        $envelope = $this->bus->dispatch($query);

        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }
}
