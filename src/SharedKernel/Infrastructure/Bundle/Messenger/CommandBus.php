<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Messenger;

use App\SharedKernel\Application\Bus\CommandBusInterface;
use App\SharedKernel\Application\Command\CommandInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\SerializerStamp;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

final class CommandBus extends Bus implements CommandBusInterface
{
    public function dispatch(CommandInterface $command): void
    {
        $configuredMessage = (new Envelope($command))->with(new SerializerStamp([
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s',
            DateTimeNormalizer::TIMEZONE_KEY => date_default_timezone_get(),
        ]));

        $this->bus->dispatch($configuredMessage);
    }
}
