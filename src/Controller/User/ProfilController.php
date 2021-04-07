<?php

namespace App\Controller\User;

use App\Entity\Avatar;
use App\Entity\User;
use App\Form\UserType3;
use App\Form\UserType4;
use App\Repository\PropertyRepository;
use App\Repository\RentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ProfilController extends AbstractController
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
     * @Route("/profil", name="profil", methods="GET|POST")
    */

    public function index(PropertyRepository $propertyRepository, RentRepository $rentRepository)
    {
        $username = $this->getUser('username')->getUsername();
        $properties = $propertyRepository->findAllProperty($username);
        $rents = $rentRepository->findAllRent($username);
        return $this->render('user/index.html.twig', [
            'properties' => $properties,
            'rents' => $rents
        ]);
    }

    /**
     * @Route("/profil/edit", name="user.edit", methods="GET|POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType3::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()) 
            {
                $this->em->flush();
                $this->addFlash('success', 'Profil modifié avec succès.');
                return $this->redirectToRoute('profil');

            }else{
                return $this->redirectToRoute('profil');
                $this->addFlash('error', 'Une erreur est survenue.');
            }
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profil/delete", name="user.delete", methods="GET|POST")
     */
    public function delete(Request $request)
    {
        $user = $this->getUser();
        $session = new Session();
        $session->invalidate();
        $this->em->remove($user);
        $this->em->flush();
        $this->addFlash('success', 'Votre compte à été supprimé');
        return $this->redirectToRoute('home');
    }

    /**
    * @Route("/profil", name="user.avatar.delete")
    */
    public function deleteImage(Avatar $picture, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($picture);
        $em->flush();
        $this->addFlash('success', 'Image de profil supprimé avec succès');
        return $this->redirectToRoute('user.index');
    }

    /**
     * @Route("/profil/{username}", name="user.public", methods="GET|POST")
     */
    public function show(User $user, PropertyRepository $propertyRepository, RentRepository $rentRepository)
    {
        $username = $user->getUsername();
        $properties = $propertyRepository->findAllProperty($username);
        $rents = $rentRepository->findAllRent($username);
        return $this->render('user/public.html.twig', [
            'user' => $user,
            'properties' => $properties,
            'rents' => $rents
        ]);
    }

}

?>