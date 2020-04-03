<?php
declare(strict_types=1);

namespace App\User\UserInterface\Controller\Security;

use App\SharedKernel\Application\Bus\CommandBusInterface;
use App\SharedKernel\Application\Bus\QueryBusInterface;
use App\SharedKernel\Application\Form\FormHandlerFactoryInterface;
use App\SharedKernel\UserInterface\Http\ResponseFactoryInterface;
use App\User\Application\Command\LoginUser;
use App\User\Application\Form\DTO\Security\SecurityDTO;
use App\User\Application\Form\Security\SecurityFormInterface;
use App\User\Application\Query\ActiveSessionsByUserEmail;
use App\User\Application\Query\UserByEmail;
use App\User\Domain\Session;
use App\User\Domain\User;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SecurityController
{
    private ResponseFactoryInterface $responseFactory;

    private FormHandlerFactoryInterface $formHandlerFactory;

    private CommandBusInterface $commandBus;

    private QueryBusInterface $queryBus;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        FormHandlerFactoryInterface $formHandlerFactory,
        CommandBusInterface $commandBus,
        QueryBusInterface $queryBus
    ) {
        $this->responseFactory = $responseFactory;
        $this->formHandlerFactory = $formHandlerFactory;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function index(Request $request): Response
    {
        $formHandler = $this->formHandlerFactory->createFromRequest($request, SecurityFormInterface::class);
        if (true === $formHandler->isSubmissionValid()) {
            /** @var SecurityDTO $dto */
            $dto = $formHandler->getData();

            /** @var User|null $user */
            $user = $this->queryBus->query(new UserByEmail($dto->email));

            if (null === $user || $user->verifyPassword($dto->password)) {
                return $this->responseFactory->error('Invalid login data');
            }

            $this->commandBus->dispatch(new LoginUser($user, $dto->rememberMe, $request->getClientIp()));

            /** @var Session[] $sessions */
            $sessions = $this->queryBus->query(new ActiveSessionsByUserEmail($user->getEmail()));

            if (0 < count($sessions) && false === $sessions[0] instanceof Session) {
                throw new RuntimeException(
                    sprintf('Failed to authorization user with email: %s', $user->getEmail())
                );
            }

            return $this->responseFactory->authorization($sessions[0]->getToken());
        }

        return $this->responseFactory->error('Failed');
    }
}
