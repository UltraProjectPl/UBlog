<?php
declare(strict_types=1);

namespace App\User\Application\Command;

use App\SharedKernel\Application\Bus\CommandHandlerInterface;
use App\SharedKernel\Application\Bus\EventBusInterface;
use App\User\Application\Event\UserLoggedIn;
use App\User\Domain\Session;
use App\User\Domain\Sessions;

class LoginUserHandler implements CommandHandlerInterface
{
    private EventBusInterface $eventBus;

    private Sessions $sessions;

    public function __construct(Sessions $sessions, EventBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
        $this->sessions = $sessions;
    }

    public function __invoke(LoginUser $command): void
    {
        $session = new Session($command->getUser(), $command->getRememberMe(), $command->getIp());

        $this->sessions->add($session);

        $this->eventBus->dispatch(new UserLoggedIn($command->getUser(), $session));
    }
}
