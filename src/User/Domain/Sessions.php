<?php
declare(strict_types=1);

namespace App\User\Domain;

interface Sessions
{
    public function add(Session $session): void;

    /**
     * @param string $email
     * @return Session[]
     */
    public function findOneActiveByUserEmail(string $email): array;

    public function findOneByToken(string $token): ?Session;
}
