<?php


namespace App\Contracts;

use App\Domain\Animal;

interface IAnimalReader
{
    public function buscarPorArete(string $arete): ?Animal;
    public function listarPorRancho(int $ranchoId): array;
    public function obtenerHistorialPeso(int $animalId): array;
    public function calcularEstadisticasRancho(int $ranchoId): array;
}