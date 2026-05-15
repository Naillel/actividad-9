<?php

namespace App;

class Circle implements ShapeInterface
{

    public function __construct(public float $radius) {}

    public function area()
    {
        return $this->radius * $this->radius * pi();
    }
}
