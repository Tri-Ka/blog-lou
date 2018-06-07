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

    public function findPopular()
    {
        return $this
            ->createQueryBuilder('t')
            ->innerJoin('t.articles', 'a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
        ;
    }
}
