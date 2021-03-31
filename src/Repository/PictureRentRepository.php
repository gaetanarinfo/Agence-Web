<?php

namespace App\Repository;

use App\Entity\PictureRent;
use App\Entity\Rent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PictureRent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureRent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureRent[]    findAll()
 * @method PictureRent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method PictureRent|null findForRent(array $rent)
 */
class PictureRentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PictureRent::class);
    }

    /**
     * @param Rent[] $rent
     * @return ArrayCollection
     */
    public function findForRent(array $rent): ArrayCollection
    {
        $qb = $this->createQueryBuilder('p');
        $pictures = $qb
            ->select('p')
            ->where(
                $qb->expr()->in(
                    'p.id',
                    $this->createQueryBuilder('p2')
                        ->select('MIN(p2.id)')
                        ->where('p2.rent IN (:rent)')
                        ->groupBy('p2.rent')
                        ->getDQL()
                )
            )
            ->getQuery()
            ->setParameter('rent', $rent)
            ->getResult();
        $pictures = array_reduce($pictures, function (array $acc, PictureRent $picture) {
            $acc[$picture->getRent()->getId()] = $picture;
            return $acc;
        }, []);
        return new ArrayCollection($pictures);
    }

}
