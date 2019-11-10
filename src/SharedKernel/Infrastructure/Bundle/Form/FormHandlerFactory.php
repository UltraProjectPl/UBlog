<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Form;

use App\SharedKernel\Application\Form\FormHandlerFactoryInterface;
use App\SharedKernel\Application\Form\FormHandlerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final class FormHandlerFactory implements FormHandlerFactoryInterface
{

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FormClassResolver
     */
    private $formClassResolver;

    public function __construct(FormFactoryInterface $formFactory, FormClassResolver $formClassResolver)
    {
        $this->formFactory = $formFactory;
        $this->formClassResolver = $formClassResolver;
    }

    public function createFromRequest(
        Request $request,
        string $type,
        $data = null,
        array $options = []
    ): FormHandlerInterface {
        return new FormHandler(
            $this->formFactory->create(
                $this->gerFormClass($type),
                $data,
                $options
            ),
            $request
        );
    }

    private function gerFormClass(string $type): string
    {
        return $this->formClassResolver->resolve($type);
    }
}
