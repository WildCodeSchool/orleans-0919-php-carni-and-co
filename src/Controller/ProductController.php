<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\FilterProductType;
use App\Repository\ProductRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
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
    ): Response {
        $products = $productRepository->findBy([], ['reference' => 'asc']);
        $formfilter = $this->createForm(FilterProductType::class);
        $formfilter->handleRequest($request);
        $data = $formfilter->getData();
        if ($formfilter->isSubmitted() && $formfilter->isValid()) {
            $products = $productRepository->findByBrand(
                $data['brand'],
                $data['food'],
                $data['animal'],
                $data['search']
            );
        }

        $products = $paginator->paginate(
            $products,
            $request->query->getInt('page', 1), /*page number*/
            self::MAX_PER_PAGE /*limit per page*/
        );
        return $this->render('user/product/index.html.twig', [
            'products' => $products,
            'formfilter' => $formfilter->createView(),
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

    /**
     * @Route("/{id}/pdf", name="product_pdf", methods={"GET"})
     */
    public function pdfView(Product $product)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('user/product/pdfView.html.twig', [
            'product' => $product,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
}
