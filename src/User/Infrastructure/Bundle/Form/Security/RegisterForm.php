<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Bundle\Form\Security;

use App\User\Application\Form\DTO\Security\RegisterDTO;
use App\User\Application\Form\Security\RegisterFormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class RegisterForm extends AbstractType implements RegisterFormInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('email', EmailType::class);
        $builder->add('password', PasswordType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RegisterDTO::class,
            'csrf_protection' => false
        ]);
    }
}
