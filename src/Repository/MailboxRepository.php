<?php

namespace App\Repository;

use App\Entity\Mailbox;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Mailbox|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mailbox|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mailbox[]    findAll()
 * @method Mailbox[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailboxRepository extends ServiceEntityRepository
{

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Mailbox::class);
        $this->paginator = $paginator;
    }

    /**
     * @return Mailbox[]
     */
    public function findLatest(): array
    {
        $mailbox = $this->findVisibleQuery()
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();

        return $mailbox;
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');

        $mailbox = $this->paginator->paginate(
            $query
            ->where('p.trash = 0')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery(),
            $page,
            12
        );

        return $mailbox;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible2(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');

        $mailbox = $this->paginator->paginate(
            $query
            ->where('p.favorite = 1')
            ->andWhere('p.trash = 0')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery(),
            $page,
            12
        );

        return $mailbox;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible3(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');

        $mailbox = $this->paginator->paginate(
            $query
            ->where('p.important = 1')
            ->andWhere('p.trash = 0')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery(),
            $page,
            12
        );

        return $mailbox;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible4(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');

        $mailbox = $this->paginator->paginate(
            $query
            ->where('p.trash = 1')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery(),
            $page,
            12
        );

        return $mailbox;
    }

    /**
     * @return Mailbox[]
     */
    public function findCountAdmin()
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
        ->select('count(p.id)')
        ->where('p.trash = 0')
        ->andWhere('p.categorie = 6')
        ->getQuery()
        ->getSingleScalarResult();

    }

    /**
     * @return Mailbox[]
     */
    public function findCountFavoriteAdmin()
    {
        $qb = $this->createQueryBuilder('p');
        
        return $qb
        ->select('count(p.favorite)')
        ->where('p.favorite = 1')
        ->andWhere('p.trash = 0')
        ->andWhere('p.categorie = 6')        
        ->getQuery()
        ->getSingleScalarResult();
    }

    /**
     * @return Mailbox[]
     */
    public function findCountImportantAdmin()
    {
        $qb = $this->createQueryBuilder('p');
    
        return $qb
        ->select('count(p.important)')
        ->where('p.important = 1')
        ->andWhere('p.trash = 0')
        ->andWhere('p.categorie = 6')         
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function findCountTrashAdmin()
    {
        $qb = $this->createQueryBuilder('p');
    
        return $qb
        ->select('count(p.trash)')
        ->where('p.trash = 1')
        ->andWhere('p.categorie = 6')         
        ->getQuery()
        ->getSingleScalarResult();
    }

      /**
     * @return Mailbox[]
     */
    public function findCountPro()
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
        ->select('count(p.id)')
        ->where('p.trash = 0')
        ->andWhere('p.categorie != 6')
        ->getQuery()
        ->getSingleScalarResult();

    }

    /**
     * @return Mailbox[]
     */
    public function findCountFavoritePro()
    {
        $qb = $this->createQueryBuilder('p');
        
        return $qb
        ->select('count(p.favorite)')
        ->where('p.favorite = 1')
        ->andWhere('p.trash = 0')
        ->andWhere('p.categorie != 6')        
        ->getQuery()
        ->getSingleScalarResult();
    }

    /**
     * @return Mailbox[]
     */
    public function findCountImportantPro()
    {
        $qb = $this->createQueryBuilder('p');
    
        return $qb
        ->select('count(p.important)')
        ->where('p.important = 1')
        ->andWhere('p.trash = 0')
        ->andWhere('p.categorie != 6')         
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function findCountTrashPro()
    {
        $qb = $this->createQueryBuilder('p');
    
        return $qb
        ->select('count(p.trash)')
        ->where('p.trash = 1')
        ->andWhere('p.categorie != 6')         
        ->getQuery()
        ->getSingleScalarResult();
    }

}
