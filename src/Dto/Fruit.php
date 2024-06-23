<?php

namespace App\Dto;

class Fruit extends Food
{

    public function getType(): string
    {
        return 'fruit';
    }
}