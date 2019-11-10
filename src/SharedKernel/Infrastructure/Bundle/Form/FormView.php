<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle\Form;

use App\SharedKernel\Application\Form\FormViewInterface;
use Symfony\Component\Form\FormView as SymfonyFormView;

final class FormView extends SymfonyFormView implements FormViewInterface
{
    /**
     * @var array
     */
    public $vars;

    /**
     * @var SymfonyFormView
     */
    public $parent;

    /**
     * @var array
     */
    public $children = [];

    public function __construct(SymfonyFormView $formView)
    {
        parent::__construct();
        $this->vars = $formView->vars;
        $this->parent = $formView->parent;
        $this->children = $formView->children;
    }
}
