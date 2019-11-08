<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\DependencyInjection;

use App\SharedKernel\Application\Bus\CommandHandler;
use App\SharedKernel\Application\Bus\EventSubscriber;
use App\SharedKernel\Application\Bus\NotificationHandler;
use App\SharedKernel\Application\Bus\QueryHandler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class SharedKernelExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(CommandHandler::class)->addTag('messenger.message_handler');
        $container->registerForAutoconfiguration(QueryHandler::class)->addTag('messenger.message_handler');
        $container->registerForAutoconfiguration(NotificationHandler::class)->addTag('messenger.message_handler');
        $container->registerForAutoconfiguration(EventSubscriber::class)->addTag('messenger.message_handler');

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resource/config')
        );

        $loader->load('services.xml');
        $loader->load('buses.xml');
    }
}
