<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
     /**
     * @Route("/", name="home_index")
     */
    public function index(AnimalRepository $animalRepository) :Response
    {
        $animals = $animalRepository->findAll();
        return $this->render('home/index.html.twig', [
            'animals' => $animals,
        ]);
    }
}
