<?php

namespace App\Controller;

use App\Dto\Food;
use App\Dto\Vegetable;
use App\Exception\FoodTypeNotSupportedException;
use App\Service\VegetableService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class VegetableController extends AbstractController
{
    public function __construct(
        private VegetableService $vegetableService
    ) {
    }
    #[Route(path: '/', name: 'api_get_vegetable_collection', methods: ['GET'])]
    public function getCollection(): JsonResponse
    {
        /** @var Food[] $vegetableCollection */
        $vegetableCollection = $this->vegetableService->getCollection();

        return new JsonResponse([
            'vegetables' => $vegetableCollection
        ]);
    }

    /**
     * @throws FoodTypeNotSupportedException
     */
    #[Route(path: '/', name: 'api_add_vegetable', methods: ['POST'])]
    public function add(
        #[MapRequestPayload] Vegetable $vegetable
    ): JsonResponse
    {
        $this->vegetableService->addVegetable($vegetable);
        return new JsonResponse($vegetable);
    }
}