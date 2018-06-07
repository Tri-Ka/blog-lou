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
use AppBundle\Entity\Tag;
use AppBundle\Type\Select2AddType;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\DataTransformer\TagsTransformer;
use AppBundle\DataTransformer\TagsViewTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\ChoicesToValuesTransformer;

class ArticleType extends AbstractType
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('content', TextareaType::class, [
            'attr' => ['data-tinymce' => ' '],
            'required' => false,
        ]);

        $builder->add('imageFile', VichImageType::class, ['required' => false]);
        $builder->add('videoFile', VichFileType::class, ['required' => false]);

        $builder->add('categories', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name',
            'multiple' => true,
            'choices_as_values' => true,
            'attr' => ['data-select2' => 'true'],
            'required' => false,
        ]);

        // $categories = $builder->getData()->getCategories();
        // $builder->get('categories')->resetViewTransformers();
        // $builder->get('categories')->addViewTransformer(new CategoriesViewTransformer($this->em, $categories), true);

        $builder->add('embededVideo', TextareaType::class, ['required' => false]);
        $choices = $this->em->getRepository('AppBundle:Tag')->findAll();

        $tags = $builder->getData()->getTags();

        $builder->add('tags', EntityType::class, [
            'class' => Tag::class,
            'choice_label' => 'label',
            'multiple' => true,
            'choices_as_values' => true,
            'attr' => ['data-select2-tags' => 'true'],
            'required' => false,
        ]);

        $builder->get('tags')->resetViewTransformers();
        $builder->get('tags')->addViewTransformer(new TagsViewTransformer($this->em, $tags), true);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        'data_class' => 'AppBundle\Entity\Article'
        ]);
    }
}
