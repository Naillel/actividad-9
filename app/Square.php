<?php 
namespace App;

class Square implements ShapeInterface{

    public function __construct(public float $width, public float $height) {
     
    }

    public function area()
    {
        $this->width * $this->height;
    }
}