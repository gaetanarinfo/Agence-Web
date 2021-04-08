<?php

namespace App\Repository;

use App\Entity\WebSiteMenu2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSiteMenu2|null find(WebSiteMenu2[]$id, $lockMode = null, $lockVersion = null)
 * @method WebSiteMenu2|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSiteMenu2[]    findAll()
 * @method WebSiteMenu2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSiteMenu2Repository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSiteMenu2::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    public function findMenu2()
    {
        $menu = $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

        return $menu;
    }
}
