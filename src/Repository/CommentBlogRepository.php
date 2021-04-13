<?php

namespace App\Repository;

use App\Entity\CommentBlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentBlog[]    findAll()
 * @method CommentBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentBlog::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.available = false');
    }

    /**
     * @return CommentBlog[]
     */
    public function findCount(int $id)
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
        ->select('count(p.id)')
        ->where('p.blogId = :ids')
        ->setParameter('ids', $id)
        ->getQuery()
        ->getSingleScalarResult();

    }

    /**
     * @return CommentBlog[]
     */
    public function findLatest(int $id): array
    {
        $comment = $this->findVisibleQuery('p')
            ->setMaxResults(25)
            ->where('p.blogId = :ids')
            ->setParameter('ids', $id)
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $comment;
    }
}
