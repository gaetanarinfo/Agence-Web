<?php
namespace App\Controller\Admin;

use App\Entity\AppartementB;
use App\Repository\AppartementBRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AppartementBType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class AdminAppartementBController extends AbstractController
{
    /**
     *
     * @var AppartementBRepository
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(AppartementBRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/appartement-b", name="admin.appartementB.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/appartementB/index.html.twig', [
            'appartementB' => $this->repository->paginateAllVisible2($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/admin/appartement-b/create", name="admin.appartementB.new")
     */
    public function new(Request $request)
    {
        $appartementB = new AppartementB();
        $form = $this->createForm(AppartementBType::class, $appartementB);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()) {
                $this->em->persist($appartementB);
                $this->em->flush();
                $this->addFlash('success', 'Appartement crée avec succès');
                return $this->redirectToRoute('admin.appartementB.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.appartementB.index');
            }
        }

        return $this->render('admin/appartementB/new.html.twig', [
            'appartementB' => $appartementB,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/appartement-b/{id}", name="admin.appartementB.edit", methods="GET|POST")
     * @param AppartementB $appartementB
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(AppartementB $appartementB, Request $request)
    {
        $form = $this->createForm(AppartementBType::class, $appartementB);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                $this->em->flush();
                $this->addFlash('success', 'Appartement modifié avec succès');
                return $this->redirectToRoute('admin.appartementB.index');
          
        }

        return $this->render('admin/appartementB/edit.html.twig', [
            'appartementB' => $appartementB,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/appartement-b/{id}", name="admin.appartementB.delete", methods="DELETE")
     */
    public function delete(AppartementB $appartementB, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $appartementB->getId(), $request->get('_token')))
        {
            $this->em->remove($appartementB);
            $this->em->flush();
            $this->addFlash('success', 'Appartement supprimé avec succès');
            return $this->redirectToRoute('admin.appartementB.index');
        }else{
            $this->addFlash('error', 'Une erreur est survenue');
            return $this->redirectToRoute('admin.appartementB.index');
        }
    }
}

?>