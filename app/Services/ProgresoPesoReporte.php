<?php

// CORRECCIÓN OCP — cada reporte en su propia clase
// Archivo: app/Reportes/ProgresoPesoReporte.php

namespace App\Reportes;

use App\Contracts\GeneradorReporte;
use App\Models\Animal;

class ProgresoPesoReporte implements GeneradorReporte
{
    public function generar(int $ranchoId): array
    {
        $animales = Animal::where('rancho_id', $ranchoId)
            ->with('registrosPeso')
            ->get();

        return $animales->map(fn($a) => [
            'animal'  => $a->nombre,
            'arete'   => $a->numero_arete,
            'gdp_kg'  => $a->calcularGananciaDiariaPromedio(),
        ])->toArray();
    }
}