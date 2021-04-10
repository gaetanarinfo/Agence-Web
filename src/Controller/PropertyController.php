<?php 

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Mailbox;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\MailboxType;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
// use Doctrine\Common\Persistence\ObjectManager;
//use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Cocur\Slugify\Slugify;

class PropertyController extends AbstractController
{

    private $repository;

    /**
     * @var PropertyRepository
     * @var EntityManagerInterface
     */

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Responce
    */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $this->repository->paginateAllVisible($search, $request->query->getInt('page', 1)),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/biens/{slug}:{id}", name="property.show") requirements={"slug": [a-z0-9\-]""}
     * @param Property $property
     * @return Response
     */
    public function show(Property $property, string $slug, Request $request): Response
    {

        $mailbox = new Mailbox();
        $form = $this->createForm(MailboxType::class, $mailbox);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $title = $property->getTitle($mailbox, $property->getTitle());
            $mailbox->setSubject($title);
            $mailbox->setCategorie('4');
            $this->em->persist($mailbox);
            $this->em->flush();
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug() 
            ]);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'sold' => $property->getSold(),
            'current_menu' => 'properties',
            'form' => $form->createView()
        ]);
    }

}

?>