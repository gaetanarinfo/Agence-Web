<?php

namespace App\Repository;

use App\Entity\PictureRent;
use App\Entity\Rent;
use App\Entity\RentSearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Rent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rent[]    findAll()
 * @method Rent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Rent::class);
        $this->paginator = $paginator;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible(RentSearch $search, int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery();

        if ($search->getMaxPrice()) {
            $query = $query
                ->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }

        if ($search->getMinSurface()) {
            $query = $query
                ->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }

        if ($search->getLat() && $search->getLng() && $search->getDistance()) {
            $query = $query
                ->andWhere('(6353 * 2 * ASIN(SQRT( POWER(SIN((p.lat - :lat) *  pi()/180 / 2), 2) +COS(p.lat * pi()/180) * COS(:lat * pi()/180) * POWER(SIN((p.lng - :lng) * pi()/180 / 2), 2) ))) <= :distance')
                ->setParameter('lng', $search->getLng())
                ->setParameter('lat', $search->getLat())
                ->setParameter('distance', $search->getDistance());
        }

        if ($search->getOptions()->count() > 0) {
            $k = 0;
            foreach($search->getOptions() as $option) {
                $k++;
                $query = $query
                     ->andWhere(":option$k MEMBER OF p.options")
                     ->setParameter("option$k", $option);

                dump($query);
            }
        }

        $rent = $this->paginator->paginate(
            $query->getQuery(),
            $page,
            12
        );

        $this->hydratePicture($rent);

        return $rent;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible2(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery();

        $properties = $this->paginator->paginate(
            $query->getQuery(),
            $page,
            12
        );


        $this->hydratePicture($properties);

        return $properties;
    }

    /**
     * @return Rent[]
     */
    public function findLatest(): array
    {
        $rent = $this->findVisibleQuery()
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
        $this->hydratePicture($rent);
        return $rent;
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.available = false');
    }

    private function hydratePicture($rent) {
        if (method_exists($rent, 'getItems')) {
            $rent = $rent->getItems();
        }
        $pictures = $this->getEntityManager()->getRepository(PictureRent::class)->findForRent($rent);
        foreach($rent as $rents) {
            /** @var $rent Rent */
            if($pictures->containsKey($rents->getId())) {
                $rents->setPicture($pictures->get($rents->getId()));
            }
        }
    }
}
