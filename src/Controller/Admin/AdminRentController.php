<?php
namespace App\Controller\Admin;

use App\Entity\Rent;
use App\Repository\RentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminRentController extends AbstractController
{
    /**
     *
     * @var RentRepository
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(RentRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/rent", name="admin.rent.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $rents = $this->repository->findAll();
        return $this->render('admin/rent/index.html.twig', compact('rents'));
    }

    /**
     * @Route("/admin/rent/create", name="admin.rent.new")
     */
    public function new(Request $request)
    {
        $rent = new Rent();
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($rent);
            $this->em->flush();
            $this->addFlash('success', 'Location crée avec succès');
            return $this->redirectToRoute('admin.rent.index');
        }

        return $this->render('admin/rent/new.html.twig', [
            'rent' => $rent,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/rent/{id}", name="admin.rent.edit", methods="GET|POST")
     * @param Rent $rent
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Rent $rent, Request $request)
    {
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Location modifié avec succès');
            return $this->redirectToRoute('admin.rent.index');
        }

        return $this->render('admin/rent/edit.html.twig', [
            'rent' => $rent,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/rent/{id}", name="admin.rent.delete", methods="DELETE")
     */
    public function delete(Rent $rent, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $rent->getId(), $request->get('_token')))
        {
            $this->em->remove($rent);
            $this->em->flush();
            $this->addFlash('success', 'Location supprimé avec succès');
        } 
        return $this->redirectToRoute('admin.rent.index');
    }
}

?>