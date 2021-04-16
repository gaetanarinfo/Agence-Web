<?php 

namespace App\Controller;

use App\Repository\WebSitePagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    /**
     * @Route("/mentions-legales", name="mentions-legales")
     * @return Responce
    */
    public function index(WebSitePagesRepository $repository): Response
    {
        $page = $repository->findOneBy(array('link' => 'mentions-legales'));
        return $this->render('pages/page.html.twig', [
            'page' => $page
        ]);
    }

    /**
     * @Route("/conditions-generales-utilisation", name="cgu")
     * @return Responce
    */
    public function index2(WebSitePagesRepository $repository): Response
    {
        $page = $repository->findOneBy(array('link' => 'cgu'));
        return $this->render('pages/page.html.twig', [
            'page' => $page
        ]);
    }

    /**
     * @Route("/charte", name="charte")
     * @return Responce
    */
    public function index3(WebSitePagesRepository $repository): Response
    {
        $page = $repository->findOneBy(array('link' => 'charte'));
        return $this->render('pages/page.html.twig', [
            'page' => $page
        ]);
    }


}