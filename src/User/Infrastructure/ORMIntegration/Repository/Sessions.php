<?php
declare(strict_types=1);

namespace App\User\Infrastructure\ORMIntegration\Repository;

use App\SharedKernel\Infrastructure\ORMIntegration\Repository\EntityRepository;
use App\User\Domain\Session;
use App\User\Domain\Sessions as DomainSessions;
use Doctrine\ORM\Query\Expr\Join;

final class Sessions extends EntityRepository implements DomainSessions
{
    public function add(Session $session): void
    {
        $this->persistEntity($session);
    }

    /**
     * @param string $email
     * @return Session[]
     */
    public function findOneActiveByUserEmail(string $email): array
    {
        return $this
            ->getORMRepository(Session::class)
            ->createQueryBuilder('s')
            ->innerJoin('s.user', 'u', Join::WITH, 'u.email = :email')
            ->andWhere('s.token IS NOT null')
            ->setParameters(['email' => $email])
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByToken(string $token): ?Session
    {
        return $this
            ->getORMRepository(Session::class)
            ->createQueryBuilder('s')
            ->where('s.token = :token')
            ->setParameters(['token' => $token])
            ->getQuery()
            ->getResult()
            ;
    }
}
