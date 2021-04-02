<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProfilController extends AbstractController
{

    /**
     * @Route("/profil", name="profil", methods="GET|POST")
     * @param UserRepository
     * @return Responce
    */

    public function index()
    {
        return $this->render('user/index.html.twig');
    }

}

?>