<?php
namespace App\Controller\Admin;

use App\Entity\AppartementA;
use App\Repository\AppartementARepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AppartementAType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class AdminAppartementAController extends AbstractController
{
    /**
     *
     * @var AppartementARepository
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(AppartementARepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/appartement-a", name="admin.appartementA.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/appartementA/index.html.twig', [
            'appartementA' => $this->repository->paginateAllVisible2($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/admin/appartement-a/create", name="admin.appartementA.new")
     */
    public function new(Request $request)
    {
        $appartementA = new AppartementA();
        $form = $this->createForm(AppartementAType::class, $appartementA);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()) {
                $this->em->persist($appartementA);
                $this->em->flush();
                $this->addFlash('success', 'Appartement crée avec succès');
                return $this->redirectToRoute('admin.appartementA.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.appartementA.index');
            }
        }

        return $this->render('admin/appartementA/new.html.twig', [
            'appaertementA' => $appartementA,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/appartement-a/{id}", name="admin.appartementA.edit", methods="GET|POST")
     * @param AppartementA $appartementA
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(AppartementA $appartementA, Request $request)
    {
        $form = $this->createForm(AppartementAType::class, $appartementA);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()) {
                $this->em->flush();
                $this->addFlash('success', 'Appartement modifié avec succès');
                return $this->redirectToRoute('admin.appartementA.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.appartementA.index');
            }
        }

        return $this->render('admin/appartementA/edit.html.twig', [
            'appartementA' => $appartementA,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/appartement-a/{id}", name="admin.appartementA.delete", methods="DELETE")
     */
    public function delete(AppartementA $appartementA, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $appartementA->getId(), $request->get('_token')))
        {
            $this->em->remove($appartementA);
            $this->em->flush();
            $this->addFlash('success', 'Appartement supprimé avec succès');
            return $this->redirectToRoute('admin.appartementA.index');
        }else{
            $this->addFlash('error', 'Une erreur est survenue');
            return $this->redirectToRoute('admin.appartementA.index');
        }
    }
}

?>