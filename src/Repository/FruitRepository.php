<?php

namespace App\Repository;

use App\Dto\Food;
use App\Exception\FoodTypeNotSupportedException;
use App\Exception\InvalidDataSourceException;
use App\Service\StorageService;
use App\Util\FoodTypeResolverTrait;

class FruitRepository
{
    use FoodTypeResolverTrait;
    private const FOOD_TYPE_ALLOWED = 'fruit';

    /**
     * @throws InvalidDataSourceException
     */
    public function __construct(
        private StorageService $storageService,
        /** @var Food[] */
        private array $fruitCollection = []
    ) {
        $this->fruitCollection = $this->getFoodCollectionByType(
            type: self::FOOD_TYPE_ALLOWED,
            dataSource: $this->storageService->getRequest()
        );
    }

    /**
     * @throws FoodTypeNotSupportedException
     */
    public function add(Food $food): void
    {
        if (!$this->support($food)) {
            throw new FoodTypeNotSupportedException("This repository only supports " . self::FOOD_TYPE_ALLOWED);
        }
        $this->fruitCollection[] = $food;
    }

    public function list(): array
    {
        return $this->fruitCollection;
    }

    public function remove(Food $food): void
    {

    }

    private function support(Food $food): bool
    {
        return $food->getType() === self::FOOD_TYPE_ALLOWED;
    }
}