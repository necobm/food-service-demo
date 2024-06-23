<?php

namespace App\Repository;

use App\Exception\InvalidDataSourceException;
use App\Service\StorageService;
use App\Util\FoodTypeResolverTrait;

class VegetableRepository extends AbstractRepository
{
    use FoodTypeResolverTrait;
    private const FOOD_TYPE_ALLOWED = 'vegetable';

    /**
     * @throws InvalidDataSourceException
     */
    public function __construct(
        protected StorageService $storageService,
    ) {
        parent::__construct(
            storageService:  $this->storageService,
            foodTypeAllowed: self::FOOD_TYPE_ALLOWED
        );
    }
}
