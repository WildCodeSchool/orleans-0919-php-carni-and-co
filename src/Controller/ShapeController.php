<?php

namespace App\Controller;

use App\Entity\Shape;
use App\Form\ShapeType;
use App\Repository\ShapeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/ingredients/forme")
 */
class ShapeController extends AbstractController
{
    /**
     * @Route("/", name="shape_index", methods={"GET"})
     */
    public function index(ShapeRepository $shapeRepository): Response
    {
        return $this->render('/admin/shape/index.html.twig', [
            'shapes' => $shapeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="shape_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $shape = new Shape();
        $form = $this->createForm(ShapeType::class, $shape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shape);
            $entityManager->flush();
            $this->addFlash('success', 'La forme a bien été ajoutée!');

            return $this->redirectToRoute('shape_index');
        }

        return $this->render('/admin/shape/new.html.twig', [
            'shape' => $shape,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shape_show", methods={"GET"})
     */
    public function show(Shape $shape): Response
    {
        return $this->render('/admin/shape/show.html.twig', [
            'shape' => $shape,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="shape_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Shape $shape): Response
    {
        $form = $this->createForm(ShapeType::class, $shape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'La forme a bien été modifiée!');

            return $this->redirectToRoute('shape_index');
        }

        return $this->render('/admin/shape/edit.html.twig', [
            'shape' => $shape,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shape_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Shape $shape): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shape->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shape);
            $entityManager->flush();
            $this->addFlash('success', 'La forme a bien été supprimée!');
        }

        return $this->redirectToRoute('shape_index');
    }
}
