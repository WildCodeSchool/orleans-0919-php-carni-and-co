<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route ("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog_index", methods={"GET"})
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'articles' => $articleRepository->FindAll(),
            'date' => 'DESC',
        ]);
    }

    /**
     * @Route("/{id}", name="blog_show", methods={"GET"})
     * @return Response
     */
    public function show(Article $article): Response
    {
        return $this->render('blog/show.html.twig', [
            'article' => $article,
        ]);
    }
}
