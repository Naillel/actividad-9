<?php

namespace App\Services;

use App\Contracts\IAnimalReader;
use App\Domain\Animal;

class ReportadorSoloLectura implements IAnimalReader
{
    public function buscarPorArete(string $arete): ?Animal
    {
        return Animal::where('numero_arete', $arete)->first();
    }

    public function listarPorRancho(int $ranchoId): array
    {
        return Animal::where('rancho_id', $ranchoId)->get()->toArray();
    }

    public function obtenerHistorialPeso(int $animalId): array
    {
        return Animal::findOrFail($animalId)
            ->registrosPeso()
            ->orderBy('fecha')
            ->get()
            ->toArray();
    }

    public function calcularEstadisticasRancho(int $ranchoId): array
    {
        $animales = Animal::where('rancho_id', $ranchoId)->get();

        return [
            'total_animales' => $animales->count(),
            'peso_promedio'  => $animales->avg('peso_inicial_kg'),
            'peso_maximo'    => $animales->max('peso_inicial_kg'),
            'peso_minimo'    => $animales->min('peso_inicial_kg'),
        ];
    }
}