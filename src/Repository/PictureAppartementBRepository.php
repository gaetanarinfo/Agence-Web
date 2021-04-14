<?php

namespace App\Repository;

use App\Entity\PictureAppartementB;
use App\Entity\AppartementB;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PictureAppartementB|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureAppartementB|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureAppartementB[]    findAll()
 * @method PictureAppartementB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method PictureAppartementB|null findForRent(array $rent)
 */
class PictureAppartementBRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PictureAppartementB::class);
    }

    /**
     * @param AppartementB[] $AppartementB
     * @return ArrayCollection
     */
    public function findForAppartementB(array $appartementB): ArrayCollection
    {
        $qb = $this->createQueryBuilder('p');
        $pictures = $qb
            ->select('p')
            ->where(
                $qb->expr()->in(
                    'p.id',
                    $this->createQueryBuilder('p2')
                        ->select('MIN(p2.id)')
                        ->where('p2.appartementB IN (:appartementB)')
                        ->groupBy('p2.appartementB')
                        ->getDQL()
                )
            )
            ->getQuery()
            ->setParameter('appartementB', $appartementB)
            ->getResult();
        $pictures = array_reduce($pictures, function (array $acc, PictureAppartementB $picture) {
            $acc[$picture->getAppartementB()->getId()] = $picture;
            return $acc;
        }, []);
        return new ArrayCollection($pictures);
    }

}
