<?php
declare(strict_types=1);

namespace App\User\UserInterface\Controller;

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

final class UserController
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

    public function data(Request $request): Response
    {
        $formHandler = $this->formHandlerFactory->createFromRequest($request, SecurityFormInterface::class);

        /** @var SecurityDTO $dto */
        $dto = $formHandler->getData();

        $user = $this->queryBus->query(new UserByEmail($dto->email));
        return $this->responseFactory->data('true');
    }
}
