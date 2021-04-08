<?php
namespace App\Controller\Admin;

use App\Entity\WebSiteFooter;
use App\Entity\WebSiteHeader;
use App\Entity\WebSiteMenu;
use App\Entity\WebSiteMenu2;
use App\Form\WebSiteFooterType;
use App\Form\WebSiteHeaderType;
use App\Form\WebSiteMenu2Type;
use App\Form\WebSiteMenuType;
use App\Repository\WebSiteFooterRepository;
use App\Repository\WebSiteHeaderRepository;
use App\Repository\WebSiteMenuRepository;
use App\Repository\WebSiteMenu2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminWebSiteController extends AbstractController
{
    /**
     *
     * @var WebSiteHeaderRepository
     * @var WebSiteFooterRepository
     * @var EntityManagerInterface
     */
    private $repository;
    private $repository2;
    private $repository3;
    private $repository4;

    public function __construct(WebSiteHeaderRepository $repository, WebSiteFooterRepository $repository2, WebSiteMenuRepository $repository3, WebSiteMenu2Repository $repository4, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->repository2 = $repository2;
        $this->repository3 = $repository3;
        $this->repository4 = $repository4;
        $this->em = $em;
    }

    /**
     * @Route("/admin/website", name="admin.website.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $websiteHeader = $this->repository->findHeader();
        $websiteMenu = $this->repository3->findMenu();
        $websiteMenu2 = $this->repository4->findMenu2();
        $websiteFooter = $this->repository2->findFooter();
        return $this->render('admin/website/index.html.twig', [
            'websiteHeader' => $websiteHeader,
            'websiteMenu' => $websiteMenu,
            'websiteMenu2' => $websiteMenu2,
            'websiteFooter' => $websiteFooter,
        ]);
    }

    /**
     * @Route("/admin/website/header/{id}", name="admin.website.editHeader", requirements={"id":"\d+"})
     * @param WebSiteHeader $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editHeader(WebSiteHeader $website, Request $request)
    {
        $form = $this->createForm(WebSiteHeaderType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $this->em->flush();
                $this->addFlash('success', 'Le header à bien été modifié');
                return $this->redirectToRoute('admin.website.index');
        }

        return $this->render('admin/website/editHeader.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/admin/website/menu/droite/{id}", name="admin.website.editMenu2", requirements={"id":"\d+"})
     * @param WebSiteMenu2 $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editMenu2(WebSiteMenu2 $website, Request $request)
    {
        $form = $this->createForm(WebSiteMenu2Type::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
           
                $this->em->flush();
                $this->addFlash('success', 'Le menu à bien été modifié');
                return $this->redirectToRoute('admin.website.index');
            
        }

        return $this->render('admin/website/editMenu2.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/menu/gauche/{id}", name="admin.website.editMenu", requirements={"id":"\d+"})
     * @param WebSiteMenu $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editMenu(WebSiteMenu $website, Request $request)
    {
        $form = $this->createForm(WebSiteMenuType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
           
                $this->em->flush();
                $this->addFlash('success', 'Le menu à bien été modifié');
                return $this->redirectToRoute('admin.website.index');
            
        }

        return $this->render('admin/website/editMenu.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/footer/{id}", name="admin.website.editFooter", requirements={"id":"\d+"})
     * @param WebSiteFooter $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editFooter(WebSiteFooter $website, Request $request)
    {
        $form = $this->createForm(WebSiteFooterType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $this->em->flush();
                $this->addFlash('success', 'Le footer à bien été modifié');
                return $this->redirectToRoute('admin.website.index');
        }

        return $this->render('admin/website/editFooter.html.twig', [
            'form' => $form->createView()
        ]);
    }

}

?>