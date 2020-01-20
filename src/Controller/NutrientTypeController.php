<?php

namespace App\Controller;

use App\Entity\NutrientType;
use App\Form\NutrientTypeType;
use App\Repository\NutrientTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ingredients/nutriment")
 */
class NutrientTypeController extends AbstractController
{
    /**
     * @Route("/", name="nutrient_type_index", methods={"GET"})
     */
    public function index(NutrientTypeRepository $nutrient): Response
    {
        return $this->render('nutrient_type/index.html.twig', [
            'nutrient_types' => $nutrient->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nutrient_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nutrientType = new NutrientType();
        $form = $this->createForm(NutrientTypeType::class, $nutrientType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nutrientType);
            $entityManager->flush();
            $this->addFlash('success', 'Le type de nutriment a bien été ajouté!');

            return $this->redirectToRoute('nutrient_type_index');
        }

        return $this->render('nutrient_type/new.html.twig', [
            'nutrient_type' => $nutrientType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nutrient_type_show", methods={"GET"})
     */
    public function show(NutrientType $nutrientType): Response
    {
        return $this->render('nutrient_type/show.html.twig', [
            'nutrient_type' => $nutrientType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nutrient_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NutrientType $nutrientType): Response
    {
        $form = $this->createForm(NutrientTypeType::class, $nutrientType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le type de nutriment a bien été modifié!');

            return $this->redirectToRoute('nutrient_type_index');
        }

        return $this->render('nutrient_type/edit.html.twig', [
            'nutrient_type' => $nutrientType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nutrient_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NutrientType $nutrientType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nutrientType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nutrientType);
            $entityManager->flush();
            $this->addFlash('success', 'Le type de nutriment a bien été supprimé!');
        }

        return $this->redirectToRoute('nutrient_type_index');
    }
}
