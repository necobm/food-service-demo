<?php

namespace App\Service;

use App\Dto\Food;
use App\Repository\FruitRepository;

class FruitService
{
    public function __construct(
        private FruitRepository $fruitRepository
    ) {
    }
    public function addFruit(Food $fruit): void
    {

    }

    public function getCollection(): array
    {
        return $this->fruitRepository->list();
    }
}