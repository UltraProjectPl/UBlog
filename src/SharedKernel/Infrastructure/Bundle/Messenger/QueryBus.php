<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Messenger;

use App\SharedKernel\Application\Bus\QueryBus as QueryBusInterface;
use App\SharedKernel\Application\Query\Query;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class QueryBus extends Bus implements QueryBusInterface
{

    public function query(Query $query)
    {
        /** @var Envelope $envelope */
        $envelope = $this->bus->dispatch($query);

        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }
}
