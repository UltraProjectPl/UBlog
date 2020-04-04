<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Bundle\Form\Security;

use App\User\Application\Form\DTO\Security\RegisterDTO;
use App\User\Application\Form\Security\RegisterFormInterface;
use App\User\Infrastructure\Bundle\Validation\UniqueEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class RegisterForm extends AbstractType implements RegisterFormInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                    new Length(['max' => 255]),
                    new UniqueEmail(),
                ]
            ])
            ->add('nick', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('birthDate', DateType::class, [
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 255]),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RegisterDTO::class,
            'csrf_protection' => false,
            'method' => Request::METHOD_POST
        ]);
    }
}
