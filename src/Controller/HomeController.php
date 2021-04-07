<?php

namespace App\Controller;

use App\Entity\Mailbox;
use App\Form\ContactHomeType;
use App\Repository\GalerieRepository;
use App\Repository\PropertyRepository;
use App\Repository\RentRepository;
use App\Repository\SliderRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @param PropertyRepository
     * @param RentRepository
     * @param UserRepository
     * @return Responce
    */

    public function index (PropertyRepository $repository, RentRepository $repositoryRent, SessionInterface $session, UserRepository $repositoryUser, Request $request):Response{

        $properties = $repository->findLatest();
        $rent = $repositoryRent->findLatest();
        $user = $repositoryUser->findLatest();
        $mailbox = new Mailbox();
        $form = $this->createForm(ContactHomeType::class, $mailbox);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($mailbox);
                $entityManager->flush();
                $this->addFlash('success', 'Votre message à bien été transmis');
                return $this->render('pages/home.html.twig', [
                    'properties' => $properties,
                    'rent' => $rent,
                    'user' => $user,
                    'form' => $form->createView()
                ]);
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->render('pages/home.html.twig', [
                    'properties' => $properties,
                    'rent' => $rent,
                    'user' => $user,
                    'form' => $form->createView()
                ]);
            }
        }

        return $this->render('pages/home.html.twig', [
            'properties' => $properties,
            'rent' => $rent,
            'user' => $user,
            'form' => $form->createView()
        ]);

    }

}

?>