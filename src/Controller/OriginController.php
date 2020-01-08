<?php

namespace App\Controller;

use App\Entity\Origin;
use App\Form\OriginType;
use App\Repository\OriginRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/ingredient/origine")
 */
class OriginController extends AbstractController
{
    /**
     * @Route("/", name="origin_index", methods={"GET"})
     */
    public function index(OriginRepository $originRepository): Response
    {
        return $this->render('origin/index.html.twig', [
            'origins' => $originRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="origin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $origin = new Origin();
        $form = $this->createForm(OriginType::class, $origin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($origin);
            $entityManager->flush();
            $this->addFlash('success', 'L\'origine a bien été ajoutée!');

            return $this->redirectToRoute('origin_index');
        }

        return $this->render('origin/new.html.twig', [
            'origin' => $origin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="origin_show", methods={"GET"})
     */
    public function show(Origin $origin): Response
    {
        return $this->render('origin/show.html.twig', [
            'origin' => $origin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="origin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Origin $origin): Response
    {
        $form = $this->createForm(OriginType::class, $origin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\'origine a bien été modifiée!');

            return $this->redirectToRoute('origin_index');
        }

        return $this->render('origin/edit.html.twig', [
            'origin' => $origin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="origin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Origin $origin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$origin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($origin);
            $entityManager->flush();
            $this->addFlash('success', 'L\'origine a bien été supprimée!');
        }

        return $this->redirectToRoute('origin_index');
    }
}
