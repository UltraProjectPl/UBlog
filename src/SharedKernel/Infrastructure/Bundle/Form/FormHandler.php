<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Form;

use App\SharedKernel\Application\Form\FormHandlerInterface;
use App\SharedKernel\Application\Form\FormViewInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

final class FormHandler implements FormHandlerInterface
{
    /**
     * @var FormInterface
     */
    private $form;

    public function __construct(FormInterface $form, Request $request)
    {
        $this->form = $form;
        $this->form->submit($request->request->all());
    }

    public function isSubmissionValid(): bool
    {
        return true === $this->form->isSubmitted() && true === $this->form->isValid();
    }

    public function getData()
    {
        return $this->form->getData();
    }

    public function createView(): FormViewInterface
    {
        return new FormView($this->form->createView());
    }
}
