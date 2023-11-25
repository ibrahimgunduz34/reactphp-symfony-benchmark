<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController {
    #[Route('/')]
    public function getIndex(): JsonResponse  {
        $data = ["status" => "OK"];
        sleep(2);
        return new JsonResponse($data, 200);
    }
}