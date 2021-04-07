<?php

namespace App\Repository;

use App\Entity\WebSiteFooter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSiteFooter|null find(WebSite[]$id, $lockMode = null, $lockVersion = null)
 * @method WebSiteFooter|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSiteFooter[]    findAll()
 * @method WebSiteFooter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSiteFooterRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSiteFooter::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    public function findFooter()
    {
        $footer = $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

        return $footer;
    }
}
