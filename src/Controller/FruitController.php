<?php

namespace App\Controller;

use App\Dto\Food;
use App\Dto\Fruit;
use App\Exception\FoodTypeNotSupportedException;
use App\Service\FruitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
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

    /**
     * @throws FoodTypeNotSupportedException
     */
    #[Route(path: '/', name: 'api_add_fruit', methods: ['POST'])]
    public function add(
        #[MapRequestPayload] Fruit $fruit
    ): JsonResponse
    {
        $this->fruitService->addFruit($fruit);
        return new JsonResponse($fruit);
    }
}