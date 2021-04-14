<?php

namespace App\Repository;

use App\Entity\OptionAppartementB;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OptionAppartementB|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionAppartementB|null find($email, $lockMode = null, $lockVersion = null)
 * @method OptionAppartementB|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionAppartementB[]    findAll()
 * @method OptionAppartementB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionAppartementBRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionAppartementB::class);
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
