<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use App\Repository\RentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @param PropertyRepository
     * @return Responce
    */

    public function index (PropertyRepository $repository, RentRepository $repositoryRent, SessionInterface $session):Response{

        $properties = $repository->findLatest();
        $rent = $repositoryRent->findLatest();
        return $this->render('pages/home.html.twig', [
            'properties' => $properties,
            'rent' => $rent
        ]);

    }

}

?>