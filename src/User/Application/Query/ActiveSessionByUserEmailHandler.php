<?php
declare(strict_types=1);

namespace App\User\Application\Query;

use App\SharedKernel\Application\Bus\QueryHandlerInterface;
use App\User\Domain\Session;
use App\User\Domain\Sessions;

final class ActiveSessionByUserEmailHandler implements QueryHandlerInterface
{
    /**
     * @var Sessions
     */
    private $sessions;

    public function __construct(Sessions $sessions)
    {
        $this->sessions = $sessions;
    }

    public function __invoke(ActiveSessionByUserEmail $query): ?Session
    {
        return $this->sessions->findOneActiveByUserEmail($query->getEmail());
    }
}
