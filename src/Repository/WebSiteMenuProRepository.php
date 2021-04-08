<?php

namespace App\Repository;

use App\Entity\WebSiteMenuPro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSiteMenuPro|null find(WebSiteMenu[]$id, $lockMode = null, $lockVersion = null)
 * @method WebSiteMenuPro|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSiteMenuPro[]    findAll()
 * @method WebSiteMenuWebSiteMenuProAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSiteMenuProRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSiteMenuPro::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    public function findMenuPro()
    {
        $menu = $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

        return $menu;
    }
}
