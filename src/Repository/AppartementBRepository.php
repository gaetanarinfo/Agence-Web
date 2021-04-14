<?php

namespace App\Repository;

use App\Entity\PictureAppartementB;
use App\Entity\AppartementB;
use App\Entity\AppartementBSearch;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method AppartementB|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppartementB|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppartementB[]    findAll()
 * @method AppartementB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppartementBRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, AppartementB::class);
        $this->paginator = $paginator;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible(AppartementBSearch $search, int $page): PaginationInterface
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

                dump($query);
            }
        }

        $appartementB = $this->paginator->paginate(
            $query
            ->orderBy('p.id', 'DESC')
            ->getQuery(),
            $page,
            12
        );

        $this->hydratePicture($appartementB);

        return $appartementB;
    }

    /**
     * @return PaginationInterface
     */
    public function paginateAllVisible2(int $page): PaginationInterface
    {
        $query = $this->findVisibleQuery('p');
        $appartementB = $this->paginator->paginate(
            $query
            ->orderBy('p.id', 'DESC')
            ->getQuery(),
            $page,
            12
        );


        $this->hydratePicture($appartementB);

        return $appartementB;
    }

    /**
     * @return AppartementB[]
     */
    public function findLatest(): array
    {
        $appartementB = $this->findVisibleQuery('p')
            ->setMaxResults(6)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
        $this->hydratePicture($appartementB);
        return $appartementB;
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.available = false');
    }

    private function hydratePicture($appartementB) {
        if (method_exists($appartementB, 'getItems')) {
            $appartementB = $appartementB->getItems();
        }
        $pictures = $this->getEntityManager()->getRepository(PictureAppartementB::class)->findForAppartementB($appartementB);
        foreach($appartementB as $appartementBs) {
            /** @var $appartementA appartementBs */
            if($pictures->containsKey($appartementBs->getId())) {
                $appartementBs->setPicture($pictures->get($appartementBs->getId()));
            }
        }
    }

    /**
     * @return AppartementB[]
     */
    public function findAllAppartementB(string $username): array
    {
        $appartementB = $this->findVisibleQuery('p')
            ->where('p.createdBy = :username')
            ->setParameter('username', $username)
            ->setMaxResults(5)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();

        return $appartementB;
    }
}
