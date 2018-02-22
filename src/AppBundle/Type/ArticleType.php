<?php

namespace AppBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;
use Symfony\Component\Validator\Constraints as Assert;

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
        $builder->add('videoFile', VichFileType::class, ['required' => false]);
        $builder->add('htags', TextareaType::class, ['required' => false]);
        $builder->add('categories', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name',
            'multiple' => true,
            'choices_as_values' => true,
            'attr' => ['data-select2' => 'true'],
            'required' => false,
        ]);

        $builder->add('embededVideo', TextareaType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Article'
        ]);
    }
}
