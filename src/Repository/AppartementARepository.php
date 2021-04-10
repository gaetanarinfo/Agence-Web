<?php

namespace App\Repository;

use App\Entity\PictureAppartementA;
use App\Entity\AppartementA;
use App\Entity\AppartementASearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method AppartementA|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppartementA|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppartementA[]    findAll()
 * @method AppartementA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppartementARepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, AppartementA::class);
        $this->paginator = $paginator;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible(AppartementASearch $search, int $page): PaginationInterface
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

        $appartementA = $this->paginator->paginate(
            $query->getQuery(),
            $page,
            12
        );

        $this->hydratePicture($appartementA);

        return $appartementA;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible2(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery();

        $appartementA = $this->paginator->paginate(
            $query->getQuery(),
            $page,
            12
        );


        $this->hydratePicture($appartementA);

        return $appartementA;
    }

    /**
     * @return AppartementA[]
     */
    public function findLatest(): array
    {
        $appartementA = $this->findVisibleQuery()
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
        $this->hydratePicture($appartementA);
        return $appartementA;
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.available = false');
    }

    private function hydratePicture($appartementA) {
        if (method_exists($appartementA, 'getItems')) {
            $appartementA = $appartementA->getItems();
        }
        $pictures = $this->getEntityManager()->getRepository(PictureAppartementA::class)->findForAppartementA($appartementA);
        foreach($appartementA as $appartementAs) {
            /** @var $appartementA AppartementA */
            if($pictures->containsKey($appartementAs->getId())) {
                $appartementAs->setPicture($pictures->get($appartementAs->getId()));
            }
        }
    }

    /**
     * @return AppartementA[]
     */
    public function findAllAppartementA(string $username): array
    {
        $appartementA = $this->findVisibleQuery('p')
            ->orderBy('p.id', 'DESC')
            ->where('p.createdBy = :username')
            ->setParameter('username', $username)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        return $appartementA;
    }
}
