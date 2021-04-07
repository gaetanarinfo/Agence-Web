<?php
namespace App\Controller\Admin;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PropertyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class AdminPropertyController extends AbstractController
{
    /**
     *
     * @var PropertyRepository
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/biens", name="admin.property.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', [
            'properties' => $this->repository->paginateAllVisible2($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/admin/biens/create", name="admin.property.new")
     */
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()) {
                $this->em->persist($property);
                $this->em->flush();
                $this->addFlash('success', 'Bien crée avec succès');
                return $this->redirectToRoute('admin.property.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.property.index');
            }
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/biens/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()) {
                $this->em->flush();
                $this->addFlash('success', 'Bien modifié avec succès');
                return $this->redirectToRoute('admin.property.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.property.index');
            }
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/biens/{id}", name="admin.property.delete", methods="DELETE")
     */
    public function delete(Property $property, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token')))
        {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
            return $this->redirectToRoute('admin.property.index');
        }else{
            $this->addFlash('error', 'Une erreur est survenue');
            return $this->redirectToRoute('admin.property.index');
        }
    }
}

?>