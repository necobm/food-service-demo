<?php

namespace App\Service;

use App\Dto\Food;
use App\Exception\FoodTypeNotSupportedException;
use App\Repository\FruitRepository;

class FruitService
{
    public function __construct(
        private FruitRepository $fruitRepository
    ) {
    }

    /**
     * @throws FoodTypeNotSupportedException
     */
    public function addFruit(Food $fruit): Food
    {
        $this->fruitRepository->add($fruit);
        return $fruit;
    }

    public function getCollection(): array
    {
        return $this->fruitRepository->list();
    }
}