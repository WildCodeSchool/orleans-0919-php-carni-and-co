<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("admin/other")
 */
class OtherTablesController extends AbstractController
{
    /**
     * @Route("/", name="other_tables_index", methods={"GET"})
     */
    public function index() : Response
    {
        return $this->render('admin/other-tables.html.twig');
    }
}
