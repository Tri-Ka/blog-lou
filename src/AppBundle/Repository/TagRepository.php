<?php

namespace AppBundle\Repository;

/**
 * TagRepository.
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Retrieve tag by label.
     *
     * @param $label
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByLabel($label)
    {
        return $this
            ->createQueryBuilder('t')
            ->andWhere('t.label = :label')
            ->setParameter('label', $label)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
