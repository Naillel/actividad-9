<?php


namespace App\Contracts;

interface PesoEstimadorClientInterface
{
   
    public function estimarPeso(array $urlsFotos, string $raza, int $edadMeses): array;
}