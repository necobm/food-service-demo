<?php

namespace App\Dto;

class Vegetable extends Food
{

    public function getType(): string
    {
        return 'vegetable';
    }
}