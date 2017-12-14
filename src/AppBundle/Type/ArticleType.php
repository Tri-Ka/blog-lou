<?php

namespace AppBundle\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('content', TextareaType::class, [
            'attr' => ['data-tinymce' => ' '],
            'required' => false,
        ]);
        $builder->add('imageFile', VichImageType::class, ['required' => false]);
        $builder->add('htags');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Article',
            'translation_domain' => 'admin',
        ]);
    }
}
