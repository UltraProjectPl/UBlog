<?php
declare(strict_types=1);

namespace App\User\Infrastructure\ORMIntegration\Repository;

use App\User\Domain\User;
use App\User\Domain\Users as DomainUsers;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

final class Users extends ServiceEntityRepository implements DomainUsers
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);
    }

    public function findOneByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = $this->findOneBy(['email' => $email]);

        return $user;
    }
}
