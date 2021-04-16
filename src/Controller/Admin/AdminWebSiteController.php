<?php
namespace App\Controller\Admin;

use App\Entity\WebSiteFooter;
use App\Entity\WebSiteFooterMenu;
use App\Entity\WebSiteHeader;
use App\Entity\WebSiteMenu;
use App\Entity\WebSiteMenu2;
use App\Entity\WebSiteMenuAdmin;
use App\Entity\WebSiteMenuPro;
use App\Entity\WebSitePages;
use App\Form\WebSiteFooterMenuType;
use App\Form\WebSiteFooterType;
use App\Form\WebSiteHeaderType;
use App\Form\WebSiteMenu2Type;
use App\Form\WebSiteMenuAdminType;
use App\Form\WebSiteMenuProType;
use App\Form\WebSiteMenuType;
use App\Form\WebSitePagesType;
use App\Repository\WebSiteFooterMenuRepository;
use App\Repository\WebSiteFooterRepository;
use App\Repository\WebSiteHeaderRepository;
use App\Repository\WebSiteMenuRepository;
use App\Repository\WebSiteMenu2Repository;
use App\Repository\WebSiteMenuAdminRepository;
use App\Repository\WebSiteMenuProRepository;
use App\Repository\WebSitePagesRepository;
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
    private $repository5;
    private $repository6;
    private $repository7;
    private $repository8;

    public function __construct(WebSiteHeaderRepository $repository, WebSiteFooterRepository $repository2, WebSiteMenuRepository $repository3, WebSiteMenu2Repository $repository4, WebSiteMenuAdminRepository $repository5, WebSiteMenuProRepository $repository6, WebSiteFooterMenuRepository $repository7, WebSitePagesRepository $repository8, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->repository2 = $repository2;
        $this->repository3 = $repository3;
        $this->repository4 = $repository4;
        $this->repository5 = $repository5;
        $this->repository6 = $repository6;
        $this->repository7 = $repository7;
        $this->repository8 = $repository8;
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
        $websiteMenuAdmin = $this->repository5->findMenuAdmin();
        $websiteMenuPro = $this->repository6->findMenuPro();
        $websiteMenuFooter = $this->repository7->findFooterMenu();
        $websitePage = $this->repository8->findPage();
        return $this->render('admin/website/index.html.twig', [
            'websiteHeader' => $websiteHeader,
            'websiteMenu' => $websiteMenu,
            'websiteMenu2' => $websiteMenu2,
            'websiteFooter' => $websiteFooter,
            'websiteMenuAdmin' => $websiteMenuAdmin,
            'websiteMenuPro' => $websiteMenuPro,
            'websiteMenuFooter' => $websiteMenuFooter,
            'websitePage' => $websitePage
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
     * @Route("/admin/website/menu/admin/{id}", name="admin.website.editMenuAdmin", requirements={"id":"\d+"})
     * @param WebSiteMenuAdmin $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editMenuAdmin(WebSiteMenuAdmin $website, Request $request)
    {
        $form = $this->createForm(WebSiteMenuAdminType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
           
                $this->em->flush();
                $this->addFlash('success', 'Le menu à bien été modifié');
                return $this->redirectToRoute('admin.website.index');
            
        }

        return $this->render('admin/website/editMenuAdmin.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/menu/pro/{id}", name="admin.website.editMenuPro", requirements={"id":"\d+"})
     * @param WebSiteMenuPro $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editMenuPro(WebSiteMenuPro $website, Request $request)
    {
        $form = $this->createForm(WebSiteMenuProType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
           
                $this->em->flush();
                $this->addFlash('success', 'Le menu à bien été modifié');
                return $this->redirectToRoute('admin.website.index');
            
        }

        return $this->render('admin/website/editMenuPro.html.twig', [
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


     /**
     * @Route("/admin/website/menu/pro/create", name="admin.website.newMenuPro")
     * @param WebSiteMenuPro $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newMenuPro(Request $request)
    {
        $website = new WebSiteMenuPro();
        $form = $this->createForm(WebSiteMenuProType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $this->em->persist($website);
                $this->em->flush();
                $this->addFlash('success', 'Bouton crée avec succès');
                return $this->redirectToRoute('admin.website.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.website.index');
            }
        }

        return $this->render('admin/website/newMenuPro.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/menu/admin/create", name="admin.website.newMenuAdmin")
     * @param WebSiteMenuAdmin $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newMenuAdmin(Request $request)
    {
        $website = new WebSiteMenuAdmin();
        $form = $this->createForm(WebSiteMenuAdminType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $this->em->persist($website);
                $this->em->flush();
                $this->addFlash('success', 'Bouton crée avec succès');
                return $this->redirectToRoute('admin.website.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.website.index');
            }
        }

        return $this->render('admin/website/newMenuAdmin.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/menu/create", name="admin.website.newMenu")
     * @param WebSiteMenu $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newMenu(Request $request)
    {
        $website = new WebSiteMenu();
        $form = $this->createForm(WebSiteMenuType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $this->em->persist($website);
                $this->em->flush();
                $this->addFlash('success', 'Bouton crée avec succès');
                return $this->redirectToRoute('admin.website.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.website.index');
            }
        }

        return $this->render('admin/website/newMenu.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/menu/pro/delete/{id}", name="admin.website.deleteMenuPro")
     */
    public function deleteMenuPro(WebSiteMenuPro $website)
    {
            $this->em->remove($website);
            $this->em->flush();
            $this->addFlash('success', 'Bouton supprimé avec succès');
            return $this->redirectToRoute('admin.website.index');
    }

    /**
     * @Route("/admin/website/menu/admin/delete/{id}", name="admin.website.deleteMenuAdmin")
     */
    public function deleteMenuAdmin(WebSiteMenuAdmin $website)
    {
            $this->em->remove($website);
            $this->em->flush();
            $this->addFlash('success', 'Bouton supprimé avec succès');
            return $this->redirectToRoute('admin.website.index');
    }

        /**
     * @Route("/admin/website/menu/delete/{id}", name="admin.website.deleteMenu")
     */
    public function deleteMenu(WebSiteMenu $website)
    {
            $this->em->remove($website);
            $this->em->flush();
            $this->addFlash('success', 'Bouton supprimé avec succès');
            return $this->redirectToRoute('admin.website.index');
    }

    /**
     * @Route("/admin/website/menu/footer/menu/create", name="admin.website.newMenuFooter")
     * @param WebSiteMenu $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newMenuFooter(Request $request)
    {
        $website = new WebSiteFooterMenu();
        $form = $this->createForm(WebSiteFooterMenuType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $this->em->persist($website);
                $this->em->flush();
                $this->addFlash('success', 'Bouton crée avec succès');
                return $this->redirectToRoute('admin.website.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.website.index');
            }
        }

        return $this->render('admin/website/newMenuFooter.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/footer/menu/{id}", name="admin.website.editMenuFooter", requirements={"id":"\d+"})
     * @param WebSiteFooterMenu $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editFooterMenu(WebSiteFooterMenu $website, Request $request)
    {
        $form = $this->createForm(WebSiteFooterMenuType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $this->em->flush();
                $this->addFlash('success', 'Le bouton à été modifié');
                return $this->redirectToRoute('admin.website.index');
        }

        return $this->render('admin/website/editMenuFooter.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/footer/menu/delete/{id}", name="admin.website.deleteMenuFooter")
     */
    public function deleteFooteRMenu(WebSiteFooterMenu $website)
    {
            $this->em->remove($website);
            $this->em->flush();
            $this->addFlash('success', 'Bouton supprimé avec succès');
            return $this->redirectToRoute('admin.website.index');
    }

    /**
     * @Route("/admin/website/page/{id}", name="admin.website.editPage", requirements={"id":"\d+"})
     * @param WebSitePages $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editPage(WebSitePages $website, Request $request)
    {
        $form = $this->createForm(WebSitePagesType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $this->em->flush();
                $this->addFlash('success', 'La page à bien été modifié');
                return $this->redirectToRoute('admin.website.index');
        }

        return $this->render('admin/website/editPage.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/website/page/delete/{id}", name="admin.website.deletePage")
     */
    public function deletePage(WebSitePages $website)
    {
            $this->em->remove($website);
            $this->em->flush();
            $this->addFlash('success', 'Page supprimé avec succès');
            return $this->redirectToRoute('admin.website.index');
    }

    /**
     * @Route("/admin/website/page/create", name="admin.website.newPage")
     * @param WebSitePages $website
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newPage(Request $request)
    {
        $website = new WebSitePages();
        $form = $this->createForm(WebSitePagesType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $this->em->persist($website);
                $this->em->flush();
                $this->addFlash('success', 'Page crée avec succès');
                return $this->redirectToRoute('admin.website.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.website.index');
            }
        }

        return $this->render('admin/website/newPage.html.twig', [
            'form' => $form->createView()
        ]);
    }

}

?>