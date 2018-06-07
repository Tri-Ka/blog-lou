<?php

namespace AppBundle\Type;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $builder->getData();
        $isNew = null === $user->getId();

        $builder->add('username');
        $builder->add('email');

        $builder->add('roles', ChoiceType::class, [
            'choices' => array_flip(User::getPossibleRoles()),
            'multiple' => true,
            'required' => true,
            'attr' => ['data-select2' => 'true'],
            'choice_translation_domain' => 'common',
            'choice_attr' => function ($val) {
                return ['data-value' => $val];
            },
        ]);

        $builder->add('enabled', CheckboxType::class, [
            'required' => false
        ]);

        $builder->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => $isNew,
            'first_options' => ['label' => 'form.password', 'required' => $isNew],
            'second_options' => ['label' => 'form.password_confirmation', 'required' => $isNew],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
            'translation_domain' => 'messages',
        ]);
    }
}
