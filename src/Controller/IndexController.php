<?php
namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController {
    private ProductRepository $repository;

    public function __construct(
        ProductRepository $repository,
    ) {
        $this->repository = $repository;
    }

    #[Route('/products/{code}')]
    public function getProduct(string $code): JsonResponse  {
        $product = $this->repository->findOneBy(['code' => $code]);
        return $this->json($product, Response::HTTP_OK);
//        return $this->json(['status' => 'ok']);
    }
}