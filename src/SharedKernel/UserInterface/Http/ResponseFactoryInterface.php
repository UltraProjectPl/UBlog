<?php
declare(strict_types=1);

namespace App\SharedKernel\UserInterface\Http;

use Symfony\Component\HttpFoundation\Response;

interface ResponseFactoryInterface
{
    public function authorization(string $token, int $status = Response::HTTP_OK): Response;

    public function create($data, int $status = Response::HTTP_CREATED): Response;

    public function error($data, int $status = Response::HTTP_BAD_REQUEST): Response;
}
