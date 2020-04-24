<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Bundle\Security;

use App\SharedKernel\Application\Bus\QueryBusInterface;
use App\User\Application\Query\UserByEmail;
use App\User\Domain\User as DomainUser;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function loadUserByUsername($username): UserInterface
    {
        if ('' === $username) {
            throw new UsernameNotFoundException('No username provider.');
        }

        if (false === filter_var($username, FILTER_VALIDATE_EMAIL)) {
            throw new UsernameNotFoundException(sprintf('Username "%s" is not a valid email address', $username));
        }

        /** @var DomainUser|null $user */
        $user = $this->queryBus->query(new UserByEmail($username));

        if (null === $user) {
            throw new UsernameNotFoundException(sprintf('User "%s" was not found.', $username));
        }

        return new User($user);
    }


    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class): bool
    {
        return User::class === $class;
    }
}