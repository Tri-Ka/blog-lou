<?php

namespace AppBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class, [
            'required' => true
        ]);

        $builder->add('lastname', TextType::class, [
            'required' => true
        ]);

        $builder->add('email', EmailType::class, [
            'required' => true
        ]);

        $builder->add('content', TextareaType::class, [
            'required' => true,
        ]);
    }
}
