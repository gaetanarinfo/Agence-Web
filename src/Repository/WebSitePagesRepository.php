<?php

namespace App\Repository;

use App\Entity\WebSitePages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSitePages|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebSitePages|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSitePages[]    findAll()
 * @method WebSitePages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSitePagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSitePages::class);
    }

    public function findPage()
    {
        $page = $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

        return $page;
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }
}
