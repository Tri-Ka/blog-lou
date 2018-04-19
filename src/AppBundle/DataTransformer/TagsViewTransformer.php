<?php

namespace AppBundle\DataTransformer;

use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TagsViewTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     * @DI\InjectParams(params={
     *      "em" = @DI\Inject("doctrine.orm.entity_manager")
     * })
     */
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function transform($tags)
    {
        $tagsArray = [];

        foreach ($tags as $k => $tag) {
            $tagsArray[] = (string)$tag->getId();
        }

        return $tagsArray;
    }

    /**
     * Transforms choice keys into entities.
     *
     * @param mixed $array An array of entities
     *
     * @return Collection A collection of entities
     */
    public function reverseTransform($array)
    {
        if (null === $array) {
            return array();
        }

        if (!is_array($array)) {
            throw new TransformationFailedException('Expected an array.');
        }

        $collection = new ArrayCollection();

        $array = array_unique($array);

        foreach ($array as $tagId) {
            $tag = $this->em->getRepository('AppBundle:Tag')->find($tagId);

            if (!$tag) {
                $tag = new Tag();
                $tag->setLabel($tagId);
            }

            $collection->add($tag);
        }

        return $collection;
    }
}
