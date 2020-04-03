<?php
declare(strict_types=1);

namespace App\User\UserInterface\Controller\Security;

use App\SharedKernel\Application\Bus\CommandBusInterface;
use App\SharedKernel\Application\Bus\QueryBusInterface;
use App\SharedKernel\Application\Form\FormHandlerFactoryInterface;
use App\SharedKernel\UserInterface\Http\ResponseFactoryInterface;
use App\User\Application\Form\DTO\Security\RegisterDTO;
use App\User\Application\Form\Security\RegisterFormInterface;
use App\User\Application\Query\UserByEmail;
use App\User\Domain\User;
use RuntimeException;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RegisterController
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
        $formHandler = $this->formHandlerFactory->createFromRequest($request, RegisterFormInterface::class);
        if (true === $formHandler->isSubmissionValid()) {
            /** @var RegisterDTO $dto */
            $dto = $formHandler->getData();

            $this->commandBus->dispatch($dto->toCommand());

            /** @var User $user */
            $user = $this->queryBus->query(new UserByEmail($dto->email));

            if (false === $user instanceof User) {
                throw new RuntimeException(
                    sprintf('Failed to create and/or retrieve user with email: "%s"', $dto->email)
                );
            }

            return $this->responseFactory->create([
                'email' => $user->getEmail()
            ]);
        }

        return $this->responseFactory->error('Failed');
    }
}
