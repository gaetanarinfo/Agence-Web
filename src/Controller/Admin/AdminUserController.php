<?php
namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Avatar;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Form\UserType2;
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
        $form = $this->createForm(UserType2::class, $user);
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
     * @Route("/admin/utilisateur/{id}", name="admin.user.edit", methods="GET|POST", requirements={"id":"\d+"})
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
            $this->addFlash('success', 'Utilisateur modifié avec succès');
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
    * @Route("/admin/utilisateur/image/{id}", name="admin.user.deleteImage")
    */
    public function deleteImage(Avatar $picture, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($picture);
        $em->flush();
        $this->addFlash('success', 'Avatar supprimé avec succès');
        return $this->redirectToRoute('admin.user.index');
    }

}