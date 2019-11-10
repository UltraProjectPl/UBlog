<?php
declare(strict_types=1);

namespace App\SharedKernel\UserInterface\Http;

use Symfony\Component\HttpFoundation\Response;

interface ResponseFactoryInterface
{
    public function create($data): Response;

    public function error($data): Response;
}
