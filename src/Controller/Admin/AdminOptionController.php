<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/option")
 */
class AdminOptionController extends AbstractController
{
    /**
     * @Route("/", name="admin.option.index", methods={"GET"})
     */
    public function index(OptionRepository $optionRepository): Response
    {
        return $this->render('admin/option/index.html.twig', [
            'options' => $optionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/cree", name="admin.option.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $option = new Option();
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($option);
                $entityManager->flush();
                $this->addFlash('success', 'Option crée avec succès');
                return $this->redirectToRoute('admin.option.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue.');
                return $this->redirectToRoute('admin.option.index');
            }
        }

        return $this->render('admin/option/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/editer", name="admin.option.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Option $option): Response
    {
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success', 'Option modifier avec succès');
                return $this->redirectToRoute('admin.option.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue.');
                return $this->redirectToRoute('admin.option.index');
            }
        }    

        return $this->render('admin/option/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="admin.option.delete")
     */
    public function delete(Request $request, Option $option): Response
    {
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($option);
            $entityManager->flush();
            $this->addFlash('success', 'Option supprimer avec succès');
            return $this->redirectToRoute('admin.option.index');
        }else{
            $this->addFlash('error', 'Option supprimer avec succès');
            return $this->redirectToRoute('admin.option.index');
        }
        
    }
}
