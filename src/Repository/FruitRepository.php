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
        $dataSource = json_decode($this->storageService->getRequest(), true);
        $newId = $this->generateId($dataSource);
        $food->setId($newId);

        $this->fruitCollection[] = $food;
        $dataSource[] = $food;

        $this->storageService->updateRequest(json_encode($dataSource));
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

    private function generateId(array $dataSource): int
    {
        $lastItem = $dataSource[count($dataSource) - 1];
        return $lastItem['id'] + 1;
    }
}