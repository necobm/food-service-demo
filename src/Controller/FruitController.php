<?php

namespace App\Controller;

use App\Dto\Food;
use App\Service\FruitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'api_get_fruit_collection', methods: ['GET'])]
class GetFruitCollectionController extends AbstractController
{
    public function __invoke(
        FruitService $fruitService
    ): JsonResponse
    {
        /** @var Food[] $fruitsCollection */
        $fruitsCollection = $fruitService->getCollection();

        return new JsonResponse([
            'fruits' => $fruitsCollection
        ]);
    }
}