<?php

namespace App\Repository;

use App\Entity\PictureBlog;
use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PictureBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureBlog[]    findAll()
 * @method PictureBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method PictureBlog|null findForRent(array $blog)
 */
class PictureBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PictureBlog::class);
    }

    /**
     * @param Blog[] $blog
     * @return ArrayCollection
     */
    public function findForBlog(array $blog): ArrayCollection
    {
        $qb = $this->createQueryBuilder('p');
        $pictures = $qb
            ->select('p')
            ->where(
                $qb->expr()->in(
                    'p.id',
                    $this->createQueryBuilder('p2')
                        ->select('MIN(p2.id)')
                        ->where('p2.blog IN (:blog)')
                        ->groupBy('p2.blog')
                        ->getDQL()
                )
            )
            ->getQuery()
            ->setParameter('blog', $blog)
            ->getResult();
        $pictures = array_reduce($pictures, function (array $acc, PictureBlog $picture) {
            $acc[$picture->getBlog()->getId()] = $picture;
            return $acc;
        }, []);
        return new ArrayCollection($pictures);
    }

}
