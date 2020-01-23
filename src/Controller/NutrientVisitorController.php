<?php

namespace App\Controller;

use App\Entity\Nutrient;
use App\Form\NutrientType;
use App\Repository\NutrientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nutrition")
 */
class NutrientVisitorController extends AbstractController
{
    /**
     * @Route("/", name="nutrition_index", methods={"GET"})
     */
    public function index(NutrientRepository $nutrientRepository): Response
    {
        return $this->render('user/nutrition/index.html.twig', [
            'nutrients' => $nutrientRepository->findAll(),
        ]);
    }
}
