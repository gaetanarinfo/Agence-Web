<?php

namespace App\Repository;

use App\Entity\Blog;
use App\Entity\BlogSearch;
use App\Entity\PictureBlog;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Blog::class);
        $this->paginator = $paginator;
    }

    /**
     * @return Blog[]
     */
    public function findLatest(): array
    {
        $blog = $this->findVisibleQuery()
            ->setMaxResults(3)
            ->where('p.roughDraft = :draft')
            ->setParameter(':draft', 1)
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $blog;
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible(BlogSearch $search, int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');

        if ($search->getCategorie()) {
            $query = $query
                ->where('p.categorie LIKE :cat')
                ->setParameter('cat', $search->getCategorie());
        }

        if ($search->getTitle()) {
            $query = $query
                ->where(
                    $query->expr()->andX(
                        $query->expr()->orX(
                            $query->expr()->like('p.title', ':query'),
                            $query->expr()->like('p.smallContent', ':query')
                        )))
                ->setParameter('query', '%' . $search->getTitle() . '%');
        }

        $blog = $this->paginator->paginate(
            $query
            ->orderBy('p.id', 'DESC')
            ->getQuery(),
            $page,
            12
        );

        $this->hydratePicture($blog);

        return $blog;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible2(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');

        $blog = $this->paginator->paginate(
            $query
            ->orderBy('p.id', 'DESC')
            ->getQuery(),
            $page,
            12
        );

        $this->hydratePicture($blog);

        return $blog;
    }


    private function hydratePicture($blogs) {
        if (method_exists($blogs, 'getItems')) {
            $blogs = $blogs->getItems();
        }
        $pictures = $this->getEntityManager()->getRepository(PictureBlog::class)->findForBlog($blogs);
        foreach($blogs as $blog) {
            /** @var $blog Blog */
            if($pictures->containsKey($blog->getId())) {
                $blog->setPicture($pictures->get($blog->getId()));
            }
        }
    }

}
