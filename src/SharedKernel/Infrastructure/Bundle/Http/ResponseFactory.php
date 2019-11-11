<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Http;

use App\SharedKernel\UserInterface\Http\ResponseFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ResponseFactory implements ResponseFactoryInterface
{

    public function create($data, int $status = Response::HTTP_CREATED): Response
    {
        return new JsonResponse([
            'message' => $data,
        ], $status);
    }

    public function error($data, int $status = Response::HTTP_BAD_REQUEST): Response
    {
        return new JsonResponse([
            'message' => $data,
        ], $status);
    }
}
