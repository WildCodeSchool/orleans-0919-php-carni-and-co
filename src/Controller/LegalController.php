<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/legal")
 */

class LegalController extends AbstractController
{
    /**
     * @Route("/", name="legal_index")
     */
    public function index(): Response
    {
        return $this->render('legals_mentions/index.html.twig');
    }
}
