<?php
declare(strict_types=1);

namespace App\User\UserInterface\Controller\Security;

use App\SharedKernel\Application\Bus\CommandBusInterface;
use App\SharedKernel\Application\Bus\QueryBusInterface;
use App\SharedKernel\UserInterface\Http\ResponseFactoryInterface;
use App\User\Application\Command\LoginUser;
use App\User\Application\Query\ActiveSessionByUserEmail;
use App\User\Application\Query\UserByEmail;
use App\User\Domain\Session;
use App\User\Domain\User;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SecurityController
{
    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var QueryBusInterface
     */
    private $queryBus;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        CommandBusInterface $commandBus,
        QueryBusInterface $queryBus
    ) {
        $this->responseFactory = $responseFactory;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function index(Request $request): Response
    {
        [$email, $password] = $request->request->all();
        $rememberMe = $request->request->get('rememberMe', false);

        /** @var User|null $user */
        $user = $this->queryBus->query(new UserByEmail($email));

        if (null === $user || $user->verifyPassword($password)) {
            return $this->responseFactory->error('Invalid login data');
        }

        $this->commandBus->dispatch(new LoginUser($user, $rememberMe, $request->getClientIp()));

        /** @var Session|null $session */
        $session = $this->queryBus->query(new ActiveSessionByUserEmail($user->getEmail()));

        if (false === $user instanceof Session) {
            throw new RuntimeException(
                sprintf('Failed to authorization user with email: %s', $user->getEmail())
            );
        }

        return $this->responseFactory->authorization($session->getToken());
    }
}
