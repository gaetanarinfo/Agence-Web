<?php

namespace App\Repository;

use App\Entity\WebSiteHeader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSiteHeader|null find(WebSite[]$id, $lockMode = null, $lockVersion = null)
 * @method WebSiteHeader|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSiteHeader[]    findAll()
 * @method WebSiteHeader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSiteHeaderRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSiteHeader::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    public function findHeader()
    {
        $header = $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

        return $header;
    }
}
