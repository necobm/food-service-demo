<?php

namespace App\Util;

use App\Exception\InvalidDataSourceException;

trait FoodTypeResolverTrait
{
    /**
     * @throws InvalidDataSourceException
     */
    function getFoodCollectionByType(string $type, string $dataSource): array
    {
        $arrayData = json_decode($dataSource, true);

        if (empty($arrayData)) {
            throw new InvalidDataSourceException('Invalid data provided');
        }

        return array_filter($arrayData, function ($item) use ($type) {
           return $item['type'] === $type;
        });
    }
}