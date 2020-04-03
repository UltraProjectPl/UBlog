<?php
declare(strict_types=1);

namespace App\User\Application\Event;

use App\SharedKernel\Application\Event\EventInterface;
use App\User\Domain\Session;
use App\User\Domain\User;

final class UserLoggedIn implements EventInterface
{
    private User $user;

    private Session $session;

    public function __construct(User $user, Session $session)
    {
        $this->user = $user;
        $this->session = $session;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
