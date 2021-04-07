<?php
namespace App\Controller\Admin;

use App\Entity\WebSiteFooter;
use App\Entity\WebSiteHeader;
use App\Form\WebSiteFooterType;
use App\Form\WebSiteHeaderType;
use App\Repository\WebSiteFooterRepository;
use App\Repository\WebSiteHeaderRepository;
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

    public function __construct(WebSiteHeaderRepository $repository, WebSiteFooterRepository $repository2, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->repository2 = $repository2;
        $this->em = $em;
    }

    /**
     * @Route("/admin/website", name="admin.website.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $websiteHeader = $this->repository->findHeader();
        $websiteFooter = $this->repository2->findFooter();
        return $this->render('admin/website/index.html.twig', [
            'websiteHeader' => $websiteHeader,
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

        if($form->isSubmitted())
        {
            if($form->isValid()){
                $this->em->flush();
                $this->addFlash('success', 'Les options on bien été modifié');
                return $this->redirectToRoute('admin.website.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.website.index');
            }
        }

        return $this->render('admin/website/editHeader.html.twig', [
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

        if($form->isSubmitted())
        {
            if($form->isValid()){
                $this->em->flush();
                $this->addFlash('success', 'Les options on bien été modifié');
                return $this->redirectToRoute('admin.website.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.website.index');
            }
        }

        return $this->render('admin/website/editFooter.html.twig', [
            'form' => $form->createView()
        ]);
    }

}

?>