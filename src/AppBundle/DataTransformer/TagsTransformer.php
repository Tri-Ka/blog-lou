<?php

namespace AppBundle\DataTransformer;

use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\Common\Collections\ArrayCollection;

class TagsTransformer implements DataTransformerInterface
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

    /**
     * @param ArrayCollection | Tag[] $value
     * @return string
     */
    public function transform($tags)
    {
        $arrayTags = [];
        foreach ($tags as $tag) {
            $arrayTags[] = $tag->getLabel();
        }
        return $arrayTags;
    }


    /**
     * @param string $value
     * @return ArrayCollection
     */
    public function reverseTransform($newtags)
    {
        $collection = new ArrayCollection();

        if (count($newtags) == 0) {
            return $newtags;
        }

        foreach ($newtags as $newtag) {
            $tagLabel = is_string($newtag) ? trim($newtag) : $newtag->getLabel();

            $tag = $this->em->getRepository('AppBundle:Tag')->findOneByLabel($tagLabel);

            if (!$tag) {
                $tag = new Tag();
                $tag->setLabel($tagLabel);
                $this->em->persist($tag);
                $this->em->flush();
            }

            $collection->add($tag);
        }

        return $collection;
    }
}
