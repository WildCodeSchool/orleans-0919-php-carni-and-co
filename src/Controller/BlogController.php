<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route ("/blog")
 */
class BlogController extends AbstractController
{
    const MAX_PER_PAGE = 5;

    /**
     * @Route("/", name="blog_index", methods={"GET"})
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function index(
        ArticleRepository $articleRepository,
        PaginatorInterface $paginator,
        Request $request
    ) : Response {
        $articles = $articleRepository->findBy([], ['date' => 'DESC']);
        $articles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1), self::MAX_PER_PAGE
        );
        return $this->render('user/blog/index.html.twig', [
            'articles' => $articles,
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
