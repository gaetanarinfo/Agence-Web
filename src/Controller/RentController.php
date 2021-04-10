<?php 

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Mailbox;
use App\Entity\Rent;
use App\Entity\RentSearch;
use App\Form\ContactType;
use App\Form\MailboxType;
use App\Form\RentSearchType;
use App\Notification\ContactNotification2;
use App\Repository\RentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{

    private $repository;

    /**
     * @var RentRepository
     * @var EntityManagerInterface
     */

    public function __construct(RentRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/louer", name="rent.index")
     * @return Responce
    */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new RentSearch();
        $form = $this->createForm(RentSearchType::class, $search);
        $form->handleRequest($request);
        return $this->render('rent/index.html.twig', [
            'current_menu2' => 'rents',
            'rent' => $this->repository->paginateAllVisible($search, $request->query->getInt('page', 1)),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/louer/{slug}:{id}", name="rent.show") requirements={"slug": [a-z0-9\-]""}
     * @param Rent $rent
     * @return Response
     */
    public function show(Rent $rent, string $slug, Request $request): Response
    {
        if($rent->getSlug() !== $slug){
            return $this->redirectToRoute('rent.show', [
                'id' => $rent->getId(),
                'slug' => $rent->getSlug()
            ], 301);
        }

        $mailbox = new Mailbox();
        $form = $this->createForm(MailboxType::class, $mailbox);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $title = $rent->getTitle($mailbox, $rent->getTitle());
            $mailbox->setSubject($title);
            $mailbox->setCategorie('4');
            $this->em->persist($mailbox);
            $this->em->flush();
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('rent.show', [
                'id' => $rent->getId(),
                'slug' => $rent->getSlug() 
            ]);
        }

        return $this->render('rent/show.html.twig', [
            'rent' => $rent,
            'available' => $rent->getAvailable(),
            'current_menu2' => 'rent',
            'form' => $form->createView()
        ]);
    }

}

?>