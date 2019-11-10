<?php
declare(strict_types=1);

namespace App\SharedKernel\Application\Form;

interface FormHandlerInterface
{
    public function isSubmissionValid(): bool;
    public function getData();
    public function createView(): FormViewInterface;
}
