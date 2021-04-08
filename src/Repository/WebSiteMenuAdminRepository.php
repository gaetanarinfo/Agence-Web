<?php

namespace App\Repository;

use App\Entity\WebSiteMenuAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSiteMenuAdmin|null find(WebSiteMenu[]$id, $lockMode = null, $lockVersion = null)
 * @method WebSiteMenuAdmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSiteMenuAdmin[]    findAll()
 * @method WebSiteMenuAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSiteMenuAdminRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSiteMenuAdmin::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    public function findMenuAdmin()
    {
        $menu = $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

        return $menu;
    }
}
