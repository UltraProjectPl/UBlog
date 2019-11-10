<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\KernelEventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

final class RequestListener
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ('json' === $request->getContentType() && $request->getContent()) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace($data);
        }
    }
}
