<?php

namespace App\Controller;

use App\Entity\Bring;
use App\Form\BringType;
use App\Repository\BringRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bring")
 */
class BringController extends AbstractController
{
    /**
     * @Route("/", name="bring_index", methods={"GET"})
     * @param BringRepository $bringRepository
     * @return Response
     */
    public function index(BringRepository $bringRepository): Response
    {
        return $this->render('bring/index.html.twig', [
            'brings' => $bringRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bring_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $bring = new Bring();
        $form = $this->createForm(BringType::class, $bring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bring);
            $entityManager->flush();

            return $this->redirectToRoute('bring_index');
        }

        return $this->render('bring/new.html.twig', [
            'bring' => $bring,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bring_show", methods={"GET"})
     * @param Bring $bring
     * @return Response
     */
    public function show(Bring $bring): Response
    {
        return $this->render('bring/show.html.twig', [
            'bring' => $bring,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bring_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Bring $bring
     * @return Response
     */
    public function edit(Request $request, Bring $bring): Response
    {
        $form = $this->createForm(BringType::class, $bring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bring_index');
        }

        return $this->render('bring/edit.html.twig', [
            'bring' => $bring,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bring_delete", methods={"DELETE"})
     * @param Request $request
     * @param Bring $bring
     * @return Response
     */
    public function delete(Request $request, Bring $bring): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bring->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bring);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bring_index');
    }
}
