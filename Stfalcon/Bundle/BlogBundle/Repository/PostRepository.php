<?php

namespace Stfalcon\Bundle\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PostRepository
 *
 * @author Stepan Tanasiychuk <ceo@stfalcon.com>
 */
class PostRepository extends EntityRepository
{

    /**
     * Get all posts
     *
     * @return array
     */
    public function getAllPosts()
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT
                p
            FROM
                StfalconBlogBundle:Post p
            ORDER BY
                p.created DESC
            ');

        return $query->getResult();
    }

    /**
     * Get last posts
     *
     * @param integer $count Max count of returned posts
     *
     * @return array
     */
    public function getLastPosts($count = null)
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT
                p
            FROM
                StfalconBlogBundle:Post p
            ORDER BY
                p.created DESC
            ');

        if ((int) $count) {
            $query->setMaxResults($count);
        }

        return $query->getResult();
    }
    
    /**
     * Get last posts
     *
     * @param integer $count Max count of returned posts
     *
     * @return array
     */
    public function getPreviousPost($current_id = null)
    {
        $previous_id = $current_id - 1 ;//UGLY !!!
        $query = $this->getEntityManager()->createQuery('
            SELECT
                p
            FROM
                StfalconBlogBundle:Post p
            WHERE p.id = :id
            ORDER BY
                p.created DESC
            ')->setParameter('id', $previous_id);


        return $query->getSingleResult();
    }
}
