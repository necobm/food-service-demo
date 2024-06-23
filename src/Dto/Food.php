<?php

namespace App\Dto;

abstract class Food
{
    public function __construct(
        public string $name,
        public string $type,
        public int $quantity,
        public string $unit,
        public ?int $id = null
    ) {
    }
    public abstract function getType(): string;

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}