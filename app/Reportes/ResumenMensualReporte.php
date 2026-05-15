<?php

// ✅ EXTENSIÓN OCP — nuevo tipo de reporte sin tocar ningún archivo existente
// Archivo: app/Reportes/ResumenMensualReporte.php
//
// Este archivo es nuevo. No se modificó ReporteService, ni la interfaz,
// ni ninguno de los otros reportes. Solo se creó este archivo y se registró
// en el ServiceProvider. Eso es OCP aplicado.

namespace App\Reportes;

use App\Contracts\GeneradorReporte;
use App\Models\Animal;

class ResumenMensualReporte implements GeneradorReporte
{
    public function generar(int $ranchoId): array
    {
        // Don Diego o el Ing. Fabio pidieron este reporte nuevo.
        // Se implementa aquí sin tocar nada de lo que ya existía.
        return Animal::where('rancho_id', $ranchoId)
            ->with('registrosPeso')
            ->get()
            ->map(fn($a) => [
                'animal'          => $a->nombre,
                'arete'           => $a->numero_arete,
                'peso_actual_kg'  => $a->registrosPeso->last()?->peso_kg,
                'variacion_mes_kg'=> $a->calcularVariacionUltimoMes(),
            ])->toArray();
    }
}