<?php

namespace App\Repository;

use App\Entity\OptionRent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OptionRent|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionRent|null find($email, $lockMode = null, $lockVersion = null)
 * @method OptionRent|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionRent[]    findAll()
 * @method OptionRent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionRentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionRent::class);
    }

    // /**
    //  * @return Option[] Returns an array of Option objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Option
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
