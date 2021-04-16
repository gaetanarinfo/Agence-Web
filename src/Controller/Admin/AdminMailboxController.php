<?php
namespace App\Controller\Admin;

use App\Entity\Mailbox;
use App\Form\ReplyMessageType;
use App\Notification\ContactNotification3;
use App\Notification\ContactNotification4;
use App\Notification\ContactNotification2;
use App\Notification\ContactNotification;
use App\Notification\ContactNotification5;
use App\Repository\MailboxRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMailboxController extends AbstractController
{
    /**
     *
     * @var MailboxRepository
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(MailboxRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/mailbox", name="admin.mailbox.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $mailboxCountAdmin = $this->repository->findCountAdmin();
        $favoriteAdmin = $this->repository->findCountFavoriteAdmin();
        $importantAdmin = $this->repository->findCountImportantAdmin();
        $trashAdmin = $this->repository->findCountTrashAdmin();

        $mailboxCountPro = $this->repository->findCountPro();
        $favoritePro = $this->repository->findCountFavoritePro();
        $importantPro = $this->repository->findCountImportantPro();
        $trashPro = $this->repository->findCountTrashPro();

        return $this->render('admin/mailbox/index.html.twig', [
            'mails' => $this->repository->paginateAllVisible($request->query->getInt('page', 1)),
            'receptionAdmin' => $mailboxCountAdmin,
            'favoriteAdmin' => $favoriteAdmin,
            'importantAdmin' => $importantAdmin,
            'trashAdmin' => $trashAdmin,
            'receptionPro' => $mailboxCountPro,
            'favoritePro' => $favoritePro,
            'importantPro' => $importantPro,
            'trashPro' => $trashPro
        ]);
    }

    /**
     * @Route("/admin/mailbox/deleteAll", name="admin.mailbox.deleteAll")
     */
    public function deleteAlls()
    {       

        $mailbox = $this->repository->findOneBy(array('trash' => '1'));
        $this->em->remove($mailbox);
        $this->em->flush();

        $this->addFlash('success', 'Message supprimé avec succès');
        return $this->redirectToRoute('admin.mailbox.index');
    }

    /**
     * @Route("/admin/mailbox/favoris", name="admin.mailbox.favoris")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function favoriteIndex(PaginatorInterface $paginator, Request $request)
    {
        $mailboxCountAdmin = $this->repository->findCountAdmin();
        $favoriteAdmin = $this->repository->findCountFavoriteAdmin();
        $importantAdmin = $this->repository->findCountImportantAdmin();
        $trashAdmin = $this->repository->findCountTrashAdmin();

        $mailboxCountPro = $this->repository->findCountPro();
        $favoritePro = $this->repository->findCountFavoritePro();
        $importantPro = $this->repository->findCountImportantPro();
        $trashPro = $this->repository->findCountTrashPro();

        return $this->render('admin/mailbox/favoris.html.twig', [
            'mails' => $this->repository->paginateAllVisible2($request->query->getInt('page', 1)),
            'receptionAdmin' => $mailboxCountAdmin,
            'favoriteAdmin' => $favoriteAdmin,
            'importantAdmin' => $importantAdmin,
            'trashAdmin' => $trashAdmin,
            'receptionPro' => $mailboxCountPro,
            'favoritePro' => $favoritePro,
            'importantPro' => $importantPro,
            'trashPro' => $trashPro
        ]);
    }

    /**
     * @Route("/admin/mailbox/important", name="admin.mailbox.importants")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function trashIndex(PaginatorInterface $paginator, Request $request)
    {
        $mailboxCountAdmin = $this->repository->findCountAdmin();
        $favoriteAdmin = $this->repository->findCountFavoriteAdmin();
        $importantAdmin = $this->repository->findCountImportantAdmin();
        $trashAdmin = $this->repository->findCountTrashAdmin();

        $mailboxCountPro = $this->repository->findCountPro();
        $favoritePro = $this->repository->findCountFavoritePro();
        $importantPro = $this->repository->findCountImportantPro();
        $trashPro = $this->repository->findCountTrashPro();

        return $this->render('admin/mailbox/importants.html.twig', [
            'mails' => $this->repository->paginateAllVisible3($request->query->getInt('page', 1)),
            'receptionAdmin' => $mailboxCountAdmin,
            'favoriteAdmin' => $favoriteAdmin,
            'importantAdmin' => $importantAdmin,
            'trashAdmin' => $trashAdmin,
            'receptionPro' => $mailboxCountPro,
            'favoritePro' => $favoritePro,
            'importantPro' => $importantPro,
            'trashPro' => $trashPro
        ]);
    }

    /**
     * @Route("/admin/mailbox/corbeille", name="admin.mailbox.trash")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function importantIndex(PaginatorInterface $paginator, Request $request)
    {
        $mailboxCountAdmin = $this->repository->findCountAdmin();
        $favoriteAdmin = $this->repository->findCountFavoriteAdmin();
        $importantAdmin = $this->repository->findCountImportantAdmin();
        $trashAdmin = $this->repository->findCountTrashAdmin();

        $mailboxCountPro = $this->repository->findCountPro();
        $favoritePro = $this->repository->findCountFavoritePro();
        $importantPro = $this->repository->findCountImportantPro();
        $trashPro = $this->repository->findCountTrashPro();

        return $this->render('admin/mailbox/trash.html.twig', [
            'mails' => $this->repository->paginateAllVisible4($request->query->getInt('page', 1)),
            'receptionAdmin' => $mailboxCountAdmin,
            'favoriteAdmin' => $favoriteAdmin,
            'importantAdmin' => $importantAdmin,
            'trashAdmin' => $trashAdmin,
            'receptionPro' => $mailboxCountPro,
            'favoritePro' => $favoritePro,
            'importantPro' => $importantPro,
            'trashPro' => $trashPro
        ]);
    }

    /**
     * @Route("admin/mailbox/marker/{id}", name="admin.mailbox.mark", methods={"GET","POST"})
     */
    public function mark(Request $request, Mailbox $mailbox): Response
    {
        $mailbox->setIsRead(1);
        $this->em->persist($mailbox);
        $this->em->flush();
        return $this->redirectToRoute('admin.mailbox.index');
    }

    /**
     * @Route("/admin/mailbox/delete/{id}", name="admin.mailbox.delete")
     */
    public function delete(Mailbox $mailbox)
    {
        $mailbox->setTrash(1);
        $this->em->persist($mailbox);
        $this->em->flush();
        return $this->redirectToRoute('admin.mailbox.index');
    }

    /**
     * @Route("/admin/mailbox/favorite/{id}", name="admin.mailbox.favorite")
     */
    public function favorite(Mailbox $mailbox)
    {
        $mailbox->setFavorite(1);
        $this->em->persist($mailbox);
        $this->em->flush();
        return $this->redirectToRoute('admin.mailbox.index');
    }

    /**
     * @Route("/admin/mailbox/important/{id}", name="admin.mailbox.important")
     */
    public function important(Mailbox $mailbox)
    {
        $mailbox->setImportant(1);
        $this->em->persist($mailbox);
        $this->em->flush();
        return $this->redirectToRoute('admin.mailbox.index');
    }

    /**
     * @Route("/admin/mailbox/deleteId/{id}", name="admin.mailbox.deleteId")
     */
    public function deleteId(Mailbox $mailbox, Request $request)
    {
        $this->em->remove($mailbox);
        $this->em->flush();
        $this->addFlash('success', 'Message supprimé avec succès');
        return $this->redirectToRoute('admin.mailbox.index');
    }

    /**
     * @Route("/admin/mailbox/message/{slug}:{id}", name="admin.mailbox.show") requirements={"slug": [a-z0-9\-]""}
     */
    public function show(Request $request, Mailbox $mailbox, string $slug, ContactNotification3 $notif3, ContactNotification2 $notif2, ContactNotification $notif, ContactNotification4 $notif4, ContactNotification5 $notif5)
    {
        
        $mailboxCountAdmin = $this->repository->findCountAdmin();
        $favoriteAdmin = $this->repository->findCountFavoriteAdmin();
        $importantAdmin = $this->repository->findCountImportantAdmin();
        $trashAdmin = $this->repository->findCountTrashAdmin();

        $mailboxCountPro = $this->repository->findCountPro();
        $favoritePro = $this->repository->findCountFavoritePro();
        $importantPro = $this->repository->findCountImportantPro();
        $trashPro = $this->repository->findCountTrashPro();

        $formAppartementA = $this->createForm(ReplyMessageType::class, $mailbox);
        $formAppartementA->handleRequest($request);

        if($formAppartementA->isSubmitted() && $formAppartementA->isValid() && $mailbox->getCategorie() == 5)
        {
            $notif3->notify($mailbox);
            $this->addFlash('success', 'Message envoyer');
            return $this->redirectToRoute('admin.mailbox.index');
        }

        $formAppartementB = $this->createForm(ReplyMessageType::class, $mailbox);
        $formAppartementB->handleRequest($request);

        if($formAppartementB->isSubmitted() && $formAppartementB->isValid() && $mailbox->getCategorie() == 7)
        {
            $notif5->notify($mailbox);
            $this->addFlash('success', 'Message envoyer');
            return $this->redirectToRoute('admin.mailbox.index');
        }

        $formRent = $this->createForm(ReplyMessageType::class, $mailbox);
        $formRent->handleRequest($request);

        if($formRent->isSubmitted() && $formRent->isValid() && $mailbox->getCategorie() == 1)
        {
            $notif2->notify($mailbox);
            $this->addFlash('success', 'Message envoyer');
            return $this->redirectToRoute('admin.mailbox.index');
        }

        $formProperty = $this->createForm(ReplyMessageType::class, $mailbox);
        $formProperty->handleRequest($request);

        if($formProperty->isSubmitted() && $formProperty->isValid() && $mailbox->getCategorie() == 0)
        {
            $notif->notify($mailbox);
            $this->addFlash('success', 'Message envoyer');
            return $this->redirectToRoute('admin.mailbox.index');
        }

        $formAdmin = $this->createForm(ReplyMessageType::class, $mailbox);
        $formAdmin->handleRequest($request);

        if($formAdmin->isSubmitted() && $formAdmin->isValid() && $mailbox->getCategorie() == 6)
        {
            $notif4->notify($mailbox);
            $this->addFlash('success', 'Message envoyer');
            return $this->redirectToRoute('admin.mailbox.index');
        }

        return $this->render('admin/mailbox/show.html.twig', [
            'mailbox' => $mailbox,
            'slug' => $mailbox->getSubject(),
            'receptionAdmin' => $mailboxCountAdmin,
            'favoriteAdmin' => $favoriteAdmin,
            'importantAdmin' => $importantAdmin,
            'trashAdmin' => $trashAdmin,
            'receptionPro' => $mailboxCountPro,
            'favoritePro' => $favoritePro,
            'importantPro' => $importantPro,
            'trashPro' => $trashPro,
            'formAppartementA' => $formAppartementA->createView(),
            'formAppartementB' => $formAppartementB->createView(),
            'formRent' => $formRent->createView(),
            'formProperty' => $formProperty->createView(),
            'formAdmin' => $formAdmin->createView()
        ]);
    }

}