<?php
declare(strict_types=1);

namespace App\User\Application\Query;

use App\SharedKernel\Application\Bus\QueryHandlerInterface;
use App\User\Domain\User;
use App\User\Domain\Users;

final class UserByEmailHandler implements QueryHandlerInterface
{
    /**
     * @var Users
     */
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function __invoke(UserByEmail $query): ?User
    {
        return $this->users->findOneByEmail($query->getEmail());
    }
}
