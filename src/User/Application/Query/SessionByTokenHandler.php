<?php
declare(strict_types=1);

namespace App\User\Application\Query;

use App\SharedKernel\Application\Bus\QueryHandlerInterface;
use App\User\Domain\Session;
use App\User\Domain\Sessions;
use App\User\Domain\Users;

final class SessionByTokenHandler implements QueryHandlerInterface
{
    private Sessions $sessions;

    public function __construct(Sessions $sessions)
    {
        $this->sessions = $sessions;
    }

    public function __invoke(SessionByToken $query): ?Session
    {
        return $this->sessions->findOneByToken($query->getToken());
    }
}
