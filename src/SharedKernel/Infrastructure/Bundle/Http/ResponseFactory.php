<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Http;

use App\SharedKernel\UserInterface\Http\ResponseFactoryInterface;
use Symfony\Component\HttpFoundation\Response;

final class ResponseFactory implements ResponseFactoryInterface
{

    public function create($data): Response
    {
        // TODO: Implement create() method.
    }

    public function error($data): Response
    {
        // TODO: Implement error() method.
    }
}
