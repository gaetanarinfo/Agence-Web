<?php

namespace App\Controller\User;

use App\Entity\Avatar;
use App\Entity\User;
use App\Form\UserType3;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

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

    public function index()
    {
        return $this->render('user/index.html.twig');
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

}

?>