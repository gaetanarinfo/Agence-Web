<?php

namespace App\Controller\Admin;

use App\Entity\OptionAppartementB;
use App\Form\OptionType4;
use App\Repository\OptionAppartementBRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/option4")
 */
class AdminOption4Controller extends AbstractController
{
    /**
     * @Route("/", name="admin.option4.index", methods={"GET"})
     */
    public function index(OptionAppartementBRepository $optionRepository): Response
    {
        return $this->render('admin/option4/index.html.twig', [
            'options' => $optionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/cree", name="admin.option4.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $option = new OptionAppartementB();
        $form = $this->createForm(OptionType4::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($option);
                $entityManager->flush();
                $this->addFlash('success', 'Option crée avec succès');
                return $this->redirectToRoute('admin.option4.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue.');
                return $this->redirectToRoute('admin.option4.index');
            }
        }

        return $this->render('admin/option2/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/editer", name="admin.option4.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OptionAppartementB $option): Response
    {
        $form = $this->createForm(OptionType4::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success', 'Option modifier avec succès');
                return $this->redirectToRoute('admin.option4.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue.');
                return $this->redirectToRoute('admin.option4.index');
            }
        }

        return $this->render('admin/option4/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="admin.option4.delete")
     */
    public function delete(Request $request, OptionAppartementB $option): Response
    {
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($option);
            $entityManager->flush();
            $this->addFlash('success', 'Option supprimer avec succès');
            return $this->redirectToRoute('admin.option4.index');     
        }else{
            $this->addFlash('error', 'Option supprimer avec succès');
            return $this->redirectToRoute('admin.option4.index');
        }
    }
}
