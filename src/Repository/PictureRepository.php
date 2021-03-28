<?php

namespace App\Repository;

use App\Entity\Picture;
use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Picture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Picture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Picture[]    findAll()
 * @method Picture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Picture|null findForProperties(array $properties)
 */
class PictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Picture::class);
    }

    /**
     * @param Property[] $properties
     * @return ArrayCollection
     */
    public function findForProperties(array $properties): ArrayCollection
    {
        $qb = $this->createQueryBuilder('p');
        $pictures = $qb
            ->select('p')
            ->where(
                $qb->expr()->in(
                    'p.id',
                    $this->createQueryBuilder('p2')
                        ->select('MIN(p2.id)')
                        ->where('p2.property IN (:properties)')
                        ->groupBy('p2.property')
                        ->getDQL()
                )
            )
            ->getQuery()
            ->setParameter('properties', $properties)
            ->getResult();
        $pictures = array_reduce($pictures, function (array $acc, Picture $picture) {
            $acc[$picture->getProperty()->getId()] = $picture;
            return $acc;
        }, []);
        return new ArrayCollection($pictures);
    }

}
