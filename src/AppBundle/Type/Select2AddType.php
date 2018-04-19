<?php
/**
 * Created by PhpStorm.
 * User: steeve
 * Date: 10/04/2018
 * Time: 11:06.
 */

namespace AppBundle\Type;

use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use AppBundle\DataTransformer\TagsTransformer;
use Doctrine\ORM\EntityManagerInterface;

class Select2AddType extends AbstractType
{
    /**
     * @var [type]
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addModelTransformer(new CollectionToArrayTransformer(), true)
            ->addModelTransformer(new TagsTransformer($this->em, $options['text_property']), true);
    }

    /**
    * @param OptionsResolver $resolver
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'text_property' => null,
                's2opts_tags' => 'true',
            )
        );

        parent::configureOptions($resolver);
    }

    public function getParent()
    {
        return EntityType::class;
    }
}
