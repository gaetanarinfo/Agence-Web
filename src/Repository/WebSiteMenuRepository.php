<?php

namespace App\Repository;

use App\Entity\WebSiteMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSiteMenu|null find(WebSiteMenu[]$id, $lockMode = null, $lockVersion = null)
 * @method WebSiteMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSiteMenu[]    findAll()
 * @method WebSiteMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSiteMenuRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSiteMenu::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    public function findMenu()
    {
        $page = $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

        return $page;
    }
}
