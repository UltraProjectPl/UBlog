<?php
declare(strict_types=1);

namespace App\SharedKernel\Application\Bus;

use App\SharedKernel\Application\Query\QueryInterface;

interface QueryBusInterface
{
    public function query(QueryInterface $query);
}
