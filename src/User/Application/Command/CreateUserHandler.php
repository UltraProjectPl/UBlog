<?php
declare(strict_types=1);

namespace App\User\Application\Command;

use App\SharedKernel\Application\Bus\CommandHandlerInterface;
use App\SharedKernel\Application\Bus\EventBusInterface;
use App\User\Application\Event\UserCreated;
use App\User\Domain\User;
use App\User\Domain\Users;
use Ramsey\Uuid\Uuid;

final class CreateUserHandler implements CommandHandlerInterface
{
    /**
     * @var Users
     */
    private $users;

    /**
     * @var EventBusInterface
     */
    private $eventBus;

    public function __construct(Users $users, EventBusInterface $eventBus)
    {
        $this->users = $users;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateUser $command)
    {
        $user = new User(
            Uuid::uuid4(),
            $command->getEmail(),
            $command->getPassword(),
            uniqid()
        );

        $this->users->add($user);

        $this->eventBus->dispatch(new UserCreated($user));
    }
}
