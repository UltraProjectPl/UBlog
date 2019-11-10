<?php
declare(strict_types=1);

namespace App\SharedKernel\Application\Form;

use Symfony\Component\HttpFoundation\Request;

interface FormHandlerFactoryInterface
{
    public function createFromRequest(
        Request $request,
        string $type,
        $data = null,
        array $options = []
    ): FormHandlerInterface;
}
