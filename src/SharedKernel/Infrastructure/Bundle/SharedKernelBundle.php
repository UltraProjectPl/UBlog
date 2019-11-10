<?php
declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Bundle;

use App\SharedKernel\Infrastructure\Bundle\DependencyInjection\CompilerPass\FormMapCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SharedKernelBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FormMapCompilerPass());
    }
}
