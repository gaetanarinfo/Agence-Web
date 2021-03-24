<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController
{

    /**
    * @var Environement
    */

    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home")
     * @return Responce
    */

    public function index ():Response{

        return new Response($this->twig->render('pages/home.html.twig'));

    }

}

?>