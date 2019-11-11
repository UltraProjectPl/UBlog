<?php
declare(strict_types=1);

namespace App\User\Application\Event;

use App\SharedKernel\Application\Event\EventInterface;
use App\User\Domain\User;

final class UserCreated implements EventInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
