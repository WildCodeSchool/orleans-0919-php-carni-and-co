<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Form\SearchProductType;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produit")
 */
class ProductController extends AbstractController
{
    const MAX_PER_PAGE = 12;

    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(
        ProductRepository $productRepository,
        Request $request,
        PaginatorInterface $paginator
    ):Response {
        $products = $productRepository->findBy([], ['reference'=>'asc']);
        $form = $this->createForm(SearchProductType::class);
        $form->handleRequest($request);
        $data = $form->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $products = $productRepository->findByReference($data['search']);
        }
        $products = $paginator->paginate(
            $products,
            $request->query->getInt('page', 1), /*page number*/
            self::MAX_PER_PAGE /*limit per page*/
        );
        return $this->render('user/product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     * @return Response
     */
    public function show(Product $product): Response
    {
        return $this->render('user/product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
