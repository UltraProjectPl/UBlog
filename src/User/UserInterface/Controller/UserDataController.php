<?php
declare(strict_types=1);

namespace App\User\UserInterface\Controller;

use App\SharedKernel\Application\Bus\QueryBusInterface;
use App\SharedKernel\UserInterface\Http\ResponseFactoryInterface;
use App\User\Application\Query\UserByEmail;
use App\User\Domain\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UserDataController
{
    private ResponseFactoryInterface $responseFactory;

    private QueryBusInterface $queryBus;

    public function __construct(ResponseFactoryInterface $responseFactory, QueryBusInterface $queryBus)
    {
        $this->responseFactory = $responseFactory;
        $this->queryBus = $queryBus;
    }

    public function index(Request $request, string $email): Response
    {
        /** @var User|null $user */
        $user = $this->queryBus->query(new UserByEmail($email));

        if ($user === null) {
            return $this->responseFactory->error(['message' => sprintf('User with email "%s" was not found.', $email)]);
        }

        return $this->responseFactory->data([
            'nick' => $user->getNick(),
            'email' => $user->getEmail(),
            'birthDate' => $user->getBirthDate()->format('Y-m-d'),
        ]);
    }
}
