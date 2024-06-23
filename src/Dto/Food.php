<?php

namespace App\Dto;

abstract class Food
{
    public function __construct(
        public int $id,
        public string $name,
        public string $type,
        public int $quantity,
        public string $unit
    ) {
    }

    public abstract function getType(): string;
}