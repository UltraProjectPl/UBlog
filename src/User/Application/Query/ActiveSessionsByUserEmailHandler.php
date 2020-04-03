<?php
declare(strict_types=1);

namespace App\User\Application\Query;

use App\SharedKernel\Application\Bus\QueryHandlerInterface;
use App\User\Domain\Session;
use App\User\Domain\Sessions;

final class ActiveSessionsByUserEmailHandler implements QueryHandlerInterface
{
    private Sessions $sessions;

    public function __construct(Sessions $sessions)
    {
        $this->sessions = $sessions;
    }

    /**
     * @param ActiveSessionsByUserEmail $query
     * @return Session[]
     */
    public function __invoke(ActiveSessionsByUserEmail $query): array
    {
        return $this->sessions->findOneActiveByUserEmail($query->getEmail());
    }
}
