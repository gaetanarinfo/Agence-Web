<?php
namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AbstractController
{
    /**
     *
     * @var UserRepository
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(UserRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/utilisateur", name="admin.user.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $users = $this->repository->findAll();
        return $this->render('admin/user/index.html.twig', [
            'users' => $this->repository->paginateAllVisible($request->query->getInt('page', 1))
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/utilisateur/create", name="admin.user.new")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Utilisateur crée avec succès');
            return $this->redirectToRoute('admin.user.index');
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/utilisateur/{id}", name="admin.user.edit", methods="GET|POST")
     * @param User $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Utilisaeur modifié avec succès');
            return $this->redirectToRoute('admin.user.index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/utilisateur/{id}", name="admin.user.delete", methods="DELETE")
     */
    public function delete(User $user, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $user->getId(), $request->get('_token')))
        {
            $this->em->remove($user);
            $this->em->flush();
            $this->addFlash('success', 'Utilisateur supprimé avec succès');
        } 
        return $this->redirectToRoute('admin.user.index');
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/utilisateur/bannir/{id}", name="admin.user.bannir", methods="GET|POST")
     * @param User $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ban(User $user, Request $request)
    {
        $user->setIsBanned(1);
        $this->em->flush();
        $this->addFlash('success', 'Utilisaeur bannis avec succès');
        return $this->redirectToRoute('admin.user.index');
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/utilisateur/debannir/{id}", name="admin.user.unbannir", methods="GET|POST")
     * @param User $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeban(User $user, Request $request)
    {
        $user->setIsBanned(0);
        $this->em->flush();
        $this->addFlash('success', 'Utilisaeur débannis avec succès');
        return $this->redirectToRoute('admin.user.index');
    }

}