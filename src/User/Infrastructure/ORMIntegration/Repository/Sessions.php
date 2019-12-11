<?php
declare(strict_types=1);

namespace App\User\Infrastructure\ORMIntegration\Repository;

use App\User\Domain\Session;
use App\User\Domain\User;
use App\User\Domain\Sessions as DomainSessions;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;

final class Sessions extends ServiceEntityRepository implements DomainSessions
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function add(Session $session): void
    {
        $this->getEntityManager()->persist($session);
        $this->getEntityManager()->flush($session);
    }

    /**
     * @param string $email
     * @return Session[]
     */
    public function findOneActiveByUserEmail(string $email): array
    {
        return $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('s')
            ->from($this->getEntityName(), 's')
            ->innerJoin('s.user', 'u', Join::WITH, 'u.email = :email')
            ->andWhere('s.token IS NOT null')
            ->setParameters(['email' => $email])
            ->getQuery()
            ->getResult()
        ;
    }
}
