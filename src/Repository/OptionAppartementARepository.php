<?php

namespace App\Repository;

use App\Entity\OptionAppartementA;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OptionAppartementA|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionAppartementA|null find($email, $lockMode = null, $lockVersion = null)
 * @method OptionAppartementA|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionAppartementA[]    findAll()
 * @method OptionAppartementA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionAppartementARepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionAppartementA::class);
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
