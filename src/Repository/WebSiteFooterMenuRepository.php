<?php

namespace App\Repository;

use App\Entity\WebSiteFooterMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSiteFooterMenu|null find(WebSite[]$id, $lockMode = null, $lockVersion = null)
 * @method WebSiteFooterMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSiteFooterMenu[]    findAll()
 * @method WebSiteFooterMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSiteFooterMenuRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSiteFooterMenu::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    public function findFooterMenu()
    {
        $footer = $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

        return $footer;
    }
}
