<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    /**
     * Retourne les articles grâce à une liste de tags
     */
    public function getAvecTags(array $nom_tags)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->join('a.tags', 't')
            ->where($qb->expr()->in('t.nom', $nom_tags));

        return $qb->getQuery()->getResult();
    }

    /**
     * Retourne le nombre de total d'articles
     *
     * @return integer
     */
    public function getTotal()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('COUNT(a)');

        return (int) $qb->getQuery()
            ->getSingleScalarResult();
    }
}
