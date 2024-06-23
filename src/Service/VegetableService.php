<?php

namespace App\Service;

use App\Dto\Food;
use App\Exception\FoodTypeNotSupportedException;
use App\Repository\VegetableRepository;

class VegetableService
{
    public function __construct(
        private VegetableRepository $vegetableRepository
    ) {
    }

    /**
     * @throws FoodTypeNotSupportedException
     */
    public function addVegetable(Food $vegetable): Food
    {
        $this->vegetableRepository->add($vegetable);
        return $vegetable;
    }

    public function getCollection(): array
    {
        return $this->vegetableRepository->list();
    }
}