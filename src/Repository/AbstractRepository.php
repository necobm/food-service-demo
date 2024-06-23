<?php

namespace App\Repository;

use App\Dto\Food;
use App\Exception\FoodTypeNotSupportedException;
use App\Exception\InvalidDataSourceException;
use App\Service\StorageService;
use App\Util\FoodTypeResolverTrait;

abstract class AbstractRepository
{
    use FoodTypeResolverTrait;

    /**
     * @throws InvalidDataSourceException
     */
    public function __construct(
        protected StorageService $storageService,
        /** @var Food[] */
        protected array $foodCollection = [],
        protected $foodTypeAllowed = ''
    )
    {
        $this->foodCollection = $this->getFoodCollectionByType(
            type: $this->foodTypeAllowed,
            dataSource: $this->storageService->getRequest()
        );
    }

    /**
     * @throws FoodTypeNotSupportedException
     */
    public function add(Food $food): void
    {
        if (!$this->support($food)) {
            throw new FoodTypeNotSupportedException("This repository only supports " . $this->foodTypeAllowed);
        }
        $dataSource = json_decode($this->storageService->getRequest(), true);
        $newId = $this->generateId($dataSource);
        $food->setId($newId);

        $this->foodCollection[] = $food;
        $dataSource[] = $food;

        $this->storageService->updateRequest(json_encode($dataSource));
    }

    public function list(): array
    {
        return $this->foodCollection;
    }

    public function remove(Food $food): void
    {

    }

    protected function support(Food $food): bool
    {
        return $food->getType() === $this->foodTypeAllowed;
    }

    protected function generateId(array $dataSource): int
    {
        $lastItem = $dataSource[count($dataSource) - 1];
        return $lastItem['id'] + 1;
    }
}
