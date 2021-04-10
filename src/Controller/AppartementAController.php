<?php 

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\AppartementA;
use App\Entity\AppartementASearch;
use App\Entity\Mailbox;
use App\Form\AppartementASearchType;
use App\Form\ContactType;
use App\Form\MailboxType;
use App\Repository\AppartementARepository;
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

class AppartementAController extends AbstractController
{

    private $repository;

    /**
     * @var AppartementARepository
     * @var EntityManagerInterface
     */

    public function __construct(AppartementARepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/appartement-a", name="appartementA.index")
     * @return Responce
    */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $search = new AppartementASearch();
        $form = $this->createForm(AppartementASearchType::class, $search);
        $form->handleRequest($request);
        return $this->render('appartementA/index.html.twig', [
            'current_menu' => 'appartementAs',
            'appartementAs' => $this->repository->paginateAllVisible($search, $request->query->getInt('page', 1)),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/appartement-a/{slug}:{id}", name="appartementA.show") requirements={"slug": [a-z0-9\-]""}
     * @param AppartementA $appartementA
     * @return Response
     */
    public function show(AppartementA $appartementA, string $slug, Request $request): Response
    {

        $mailbox = new Mailbox();
        $form = $this->createForm(MailboxType::class, $mailbox);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $title = $appartementA->getTitle($mailbox, $appartementA->getTitle());
                $mailbox->setSubject($title);
                $mailbox->setCategorie('4');
                $this->em->persist($mailbox);
                $this->em->flush();
                $this->addFlash('success', 'Votre message a bien été envoyé');
                return $this->redirectToRoute('appartementA.show', [
                    'id' => $appartementA->getId(),
                    'slug' => $appartementA->getSlug() 
                ]);
        }

        return $this->render('appartementA/show.html.twig', [
            'appartementA' => $appartementA,
            'available' => $appartementA->getAvailable(),
            'current_menu' => 'appartementA',
            'form' => $form->createView()
        ]);
    }

}

?>