<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Form\SearchIngredientType;
use App\Repository\IngredientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ingredient")
 */
class IngredientController extends AbstractController
{
    const MAX_PER_PAGE = 20;

    /**
     * @Route("/", name="ingredient_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, IngredientRepository $ingredientRepository, Request $request)
    {
        $ingredients = $ingredientRepository->findBy([], ['name'=>'asc']);
        $form = $this->createForm(SearchIngredientType::class);
        $form->handleRequest($request);
        $data = $form->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredients = $ingredientRepository->findByName($data['search']);
        }
        $ingredients = $paginator->paginate(
            $ingredients,
            $request->query->getInt('page', 1), /*page number*/
            self::MAX_PER_PAGE /*limit per page*/
        );
        return $this->render('/admin/ingredient/index.html.twig', [
            'ingredients' => $ingredients,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="ingredient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingredient);
            $entityManager->flush();
            $this->addFlash('success', 'L\'ingrédient a bien été ajouté!');

            return $this->redirectToRoute('ingredient_index');
        }

        return $this->render('/admin/ingredient/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_show", methods={"GET"})
     */
    public function show(Ingredient $ingredient): Response
    {
        return $this->render('/admin/ingredient/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ingredient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ingredient $ingredient): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\'ingrédient a bien été modifié!');

            return $this->redirectToRoute('ingredient_index');
        }

        return $this->render('/admin/ingredient/edit.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ingredient $ingredient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredient);
            $entityManager->flush();
            $this->addFlash('success', 'L\'ingrédient a bien été supprimé!');
        }

        return $this->redirectToRoute('ingredient_index');
    }
}
