<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 19/06/18
 * Time: 12:16
 */

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductPaginatedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 */
class ProductController extends Controller
{
    /**
     * Liste des produits
     *
     * @Route("/produits/{page}",
     *     name="app_product_list",
     *     defaults={"page": "1"},
     *     requirements={"page"="\d+"}
     *     )
     *
     * @param ProductPaginatedRepository $paginatedRepository
     * @param string                     $page
     *
     * @return Response
     */
    public function index(ProductPaginatedRepository $paginatedRepository, $page): Response
    {
        $page = (int) $page;

        $paginatedRepository->setPage($page - 1);

        /** @var Product[] $products */
        $products = $paginatedRepository->get();

        $pageCount = $paginatedRepository->getLastPageCount();

        return $this->render(
            'product/index.html.twig', array(
                'products'  => $products,
                'pageCount' => $pageCount,
            )
        );
    }

    /**
     * Liste des produits filtrés par name
     *
     * @Route("/produits/par_nom/{page}",
     *     name="app_product_list_by_name",
     *     defaults={"page": "1"},
     *     requirements={"page"="\d+"}
     *     )
     *
     * @param ProductPaginatedRepository $paginatedRepository
     * @param Request                    $request
     * @param string                     $page
     *
     * @return Response
     */
    public function indexByName(ProductPaginatedRepository $paginatedRepository, Request $request, $page): Response
    {
        $page = (int) $page;

        $paginatedRepository->setPage($page - 1);

        $nom = $request->query->get('motif', '');

        if ($nom === '') {
            return $this->redirectToRoute('app_product_list');
        }

        /** @var Product[] $products */
        $products = $paginatedRepository->getByName($nom);

        $pageCount = $paginatedRepository->getLastPageCount();

        return $this->render(
            'product/index_by_name.html.twig', array(
                'products'  => $products,
                'pageCount' => $pageCount,
                'motif'     => $nom,
            )
        );
    }

    /**
     * Liste des produits filtrés par name
     *
     * @Route("/produits/par_reference/{page}",
     *     name="app_product_list_by_reference",
     *     defaults={"page": "1"},
     *     requirements={"page"="\d+"}
     *     )
     *
     * @param ProductPaginatedRepository $paginatedRepository
     * @param Request                    $request
     * @param string                     $page
     *
     * @return Response
     */
    public function indexByReference(ProductPaginatedRepository $paginatedRepository, Request $request, $page): Response
    {
        $page = (int) $page;

        $paginatedRepository->setPage($page - 1);

        $reference = $request->query->get('motif', '');

        if ($reference === '') {
            return $this->redirectToRoute('app_product_list');
        }

        /** @var Product[] $products */
        $products = $paginatedRepository->getByReference($reference);

        $pageCount = $paginatedRepository->getLastPageCount();

        return $this->render(
            'product/index_by_reference.html.twig', array(
                'products'  => $products,
                'pageCount' => $pageCount,
                'motif'     => $reference,
            )
        );
    }
}
