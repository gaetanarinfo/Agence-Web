<?php 

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\AppartementB;
use App\Entity\AppartementBSearch;
use App\Entity\Mailbox;
use App\Form\AppartementBSearchType;
use App\Form\ContactType;
use App\Form\MailboxType;
use App\Repository\AppartementBRepository;
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

class AppartementBController extends AbstractController
{

    private $repository;

    /**
     * @var AppartementBRepository
     * @var EntityManagerInterface
     */

    public function __construct(AppartementBRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/appartement-b", name="AppartementB.index")
     * @return Responce
    */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $search = new AppartementBSearch();
        $form = $this->createForm(AppartementBSearchType::class, $search);
        $form->handleRequest($request);
        return $this->render('appartementB/index.html.twig', [
            'current_menu' => 'appartementBs',
            'appartementBs' => $this->repository->paginateAllVisible($search, $request->query->getInt('page', 1)),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/appartement-b/{slug}:{id}", name="appartementB.show") requirements={"slug": [a-z0-9\-]""}
     * @param AppartementB $appartementB
     * @return Response
     */
    public function show(AppartementB $appartementB, string $slug, Request $request): Response
    {

        $mailbox = new Mailbox();
        $form = $this->createForm(MailboxType::class, $mailbox);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $title = $appartementB->getTitle($mailbox, $appartementB->getTitle());
                $mailbox->setSubject($title);
                $mailbox->setCategorie('5');
                $this->em->persist($mailbox);
                $this->em->flush();
                $this->addFlash('success', 'Votre message a bien été envoyé');
                return $this->redirectToRoute('appartementB.show', [
                    'id' => $appartementB->getId(),
                    'slug' => $appartementB->getSlug() 
                ]);
        }

        return $this->render('appartementB/show.html.twig', [
            'appartementB' => $appartementB,
            'available' => $appartementB->getAvailable(),
            'current_menu' => 'appartementB',
            'form' => $form->createView()
        ]);
    }

}

?>