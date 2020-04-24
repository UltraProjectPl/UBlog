<?php
declare(strict_types=1);

namespace App\User\Infrastructure\ORMIntegration\Repository;

use App\SharedKernel\Infrastructure\ORMIntegration\Repository\EntityRepository;
use App\User\Domain\User;
use App\User\Domain\Users as DomainUsers;

final class Users extends EntityRepository implements DomainUsers
{
    public function add(User $user): void
    {
        $this->persistEntity($user);
    }

    public function findOneByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = $this->getORMRepository(User::class)->findOneBy(['email' => $email]);

        return $user;
    }
}
