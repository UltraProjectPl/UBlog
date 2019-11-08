<?php
declare(strict_types=1);

namespace App\SharedKernel\Application\Bus;

use App\SharedKernel\Application\Query\Query;

interface QueryBus
{
    public function query(Query $query);
}
