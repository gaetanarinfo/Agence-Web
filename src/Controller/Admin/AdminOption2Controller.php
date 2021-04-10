<?php

namespace App\Controller\Admin;

use App\Entity\OptionRent;
use App\Form\OptionType2;
use App\Repository\OptionRentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/option2")
 */
class AdminOption2Controller extends AbstractController
{
    /**
     * @Route("/", name="admin.option2.index", methods={"GET"})
     */
    public function index(OptionRentRepository $optionRepository): Response
    {
        return $this->render('admin/option2/index.html.twig', [
            'options' => $optionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/cree", name="admin.option2.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $option = new OptionRent();
        $form = $this->createForm(OptionType2::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($option);
                $entityManager->flush();
                $this->addFlash('success', 'Option crée avec succès');
                return $this->redirectToRoute('admin.option2.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue.');
                return $this->redirectToRoute('admin.option2.index');
            }
        }

        return $this->render('admin/option2/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/editer", name="admin.option2.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OptionRent $option): Response
    {
        $form = $this->createForm(OptionType2::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success', 'Option modifier avec succès');
                return $this->redirectToRoute('admin.option2.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue.');
                return $this->redirectToRoute('admin.option2.index');
            }
        }

        return $this->render('admin/option2/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="admin.option2.delete")
     */
    public function delete(Request $request, OptionRent $option): Response
    {
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($option);
            $entityManager->flush();
            $this->addFlash('success', 'Option supprimer avec succès');
            return $this->redirectToRoute('admin.option2.index');     
        }else{
            $this->addFlash('error', 'Option supprimer avec succès');
            return $this->redirectToRoute('admin.option2.index');
        }
    }
}
