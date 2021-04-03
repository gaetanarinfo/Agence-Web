<?php
namespace App\Controller\Admin;

use App\Entity\Rent;
use App\Repository\RentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RentType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/louer", name="admin.rent.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $rents = $this->repository->findAll();
        return $this->render('admin/rent/index.html.twig', [
            'rents' => $this->repository->paginateAllVisible2($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/louer/create", name="admin.rent.new")
     */
    public function new(Request $request)
    {
        $rent = new Rent();
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()) {
                $this->em->persist($rent);
                $this->em->flush();
                $this->addFlash('success', 'Location crée avec succès');
                return $this->redirectToRoute('admin.rent.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.rent.index');
            }
        }

        return $this->render('admin/rent/new.html.twig', [
            'rent' => $rent,
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/louer/{id}", name="admin.rent.edit", methods="GET|POST")
     * @param Rent $rent
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Rent $rent, Request $request)
    {
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()){
                $this->em->flush();
                $this->addFlash('success', 'Location modifié avec succès');
                return $this->redirectToRoute('admin.rent.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.rent.index');
            }
        }

        return $this->render('admin/rent/edit.html.twig', [
            'rent' => $rent,
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/louer/{id}", name="admin.rent.delete", methods="DELETE")
     */
    public function delete(Rent $rent, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $rent->getId(), $request->get('_token')))
        {
            $this->em->remove($rent);
            $this->em->flush();
            $this->addFlash('success', 'Location supprimé avec succès');
            return $this->redirectToRoute('admin.rent.index');
        }else{
            $this->addFlash('error', 'Une erreur est survenue');
            return $this->redirectToRoute('admin.rent.index');
        }
    }
       
}

?>