<?php

namespace App\Tests\App\Util;

use App\Exception\InvalidDataSourceException;
use App\Util\FoodTypeResolverTrait;
use PHPUnit\Framework\TestCase;

class FoodTypeResolverTraitTest extends TestCase
{
    use FoodTypeResolverTrait;
    public function testGetFruitsCollection()
    {
        $collection = $this->getFoodCollectionByType('fruit', json_encode($this->getTestData()));
        $this->assertIsArray($collection);
        $this->assertCount(2, $collection);
    }

    public function testGetVegetablesCollection()
    {
        $collection = $this->getFoodCollectionByType('vegetable', json_encode($this->getTestData()));
        $this->assertIsArray($collection);
        $this->assertCount(1, $collection);
    }

    public function testGetFoodCollectionByTypeThrowsException()
    {
        $this->expectException(InvalidDataSourceException::class);
        $collection = $this->getFoodCollectionByType('vegetable', json_encode([]));
    }

    private function getTestData(): array
    {
        return [
            [
                'type' => 'fruit',
                'name' => 'Mango'
            ],
            [
                'type' => 'fruit',
                'name' => 'Apples'
            ],
            [
                'type' => 'vegetable',
                'name' => 'Carrot'
            ],
        ];
    }
}