<?php

namespace App\Repository;

use App\Entity\Picture;
use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Property|null find(Property[]$id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Property::class);
        $this->paginator = $paginator;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible(PropertySearch $search, int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');

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
            }
        }

        $properties = $this->paginator->paginate(
            $query
            ->orderBy('p.id', 'DESC')
            ->getQuery(),
            $page,
            12
        );


        $this->hydratePicture($properties);

        return $properties;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible2(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');

        $properties = $this->paginator->paginate(
            $query
            ->orderBy('p.id', 'DESC')
            ->getQuery(),
            $page,
            12
        );


        $this->hydratePicture($properties);

        return $properties;
    }

    /**
     * @return Property[]
     */
    public function findLatest(): array
    {
        $properties = $this->findVisibleQuery('p')
            ->setMaxResults(6)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
        $this->hydratePicture($properties);
        return $properties;
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
    }

    private function hydratePicture($properties) {
        if (method_exists($properties, 'getItems')) {
            $properties = $properties->getItems();
        }
        $pictures = $this->getEntityManager()->getRepository(Picture::class)->findForProperties($properties);
        foreach($properties as $property) {
            /** @var $property Property */
            if($pictures->containsKey($property->getId())) {
                $property->setPicture($pictures->get($property->getId()));
            }
        }
    }

    /**
     * @return Property[]
     */
    public function findAllProperty(string $username): array
    {
        $property = $this->findVisibleQuery('p')
            ->orderBy('p.id', 'DESC')
            ->where('p.createdBy = :username')
            ->setParameter('username', $username)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        return $property;
    }
}
