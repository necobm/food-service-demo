<?php

namespace App\Controller;

use App\Dto\Food;
use App\Service\FruitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FruitController extends AbstractController
{
    public function __construct(
        private FruitService $fruitService
    ) {
    }
    #[Route(path: '/', name: 'api_get_fruit_collection', methods: ['GET'])]
    public function getCollection(): JsonResponse
    {
        /** @var Food[] $fruitsCollection */
        $fruitsCollection = $this->fruitService->getCollection();

        return new JsonResponse([
            'fruits' => $fruitsCollection
        ]);
    }
}