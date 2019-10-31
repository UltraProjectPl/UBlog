<?php
declare(strict_types=1);

namespace App\User\Domain;

use Ramsey\Uuid\UuidInterface;

final class User
{
    /**
     * @var UuidInterface
     */
    private $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
