<?php 

namespace App\Controller;

use App\Repository\RentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{

    private $repository;

    /**
     * @var RentRepository
     * @var EntityManagerInterface
     */

    public function __construct(RentRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/louer", name="rent.index")
     * @return Responce
    */

    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return $this->render('rent/index.html.twig', [
            'current_menu2' => 'rent'
        ]);
    }

}

?>