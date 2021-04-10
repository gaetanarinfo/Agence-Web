<?php

namespace App\Repository;

use App\Entity\PictureAppartementA;
use App\Entity\AppartementA;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PictureAppartementA|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureAppartementA|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureAppartementA[]    findAll()
 * @method PictureAppartementA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method PictureAppartementA|null findForRent(array $rent)
 */
class PictureAppartementARepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PictureAppartementA::class);
    }

    /**
     * @param AppartementA[] $appartementA
     * @return ArrayCollection
     */
    public function findForAppartementA(array $appartementA): ArrayCollection
    {
        $qb = $this->createQueryBuilder('p');
        $pictures = $qb
            ->select('p')
            ->where(
                $qb->expr()->in(
                    'p.id',
                    $this->createQueryBuilder('p2')
                        ->select('MIN(p2.id)')
                        ->where('p2.appartementA IN (:appartementA)')
                        ->groupBy('p2.appartementA')
                        ->getDQL()
                )
            )
            ->getQuery()
            ->setParameter('appartementA', $appartementA)
            ->getResult();
        $pictures = array_reduce($pictures, function (array $acc, PictureAppartementA $picture) {
            $acc[$picture->getAppartementA()->getId()] = $picture;
            return $acc;
        }, []);
        return new ArrayCollection($pictures);
    }

}
