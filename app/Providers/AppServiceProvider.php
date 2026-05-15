<?php

// ✅ CORRECCIÓN OCP — cómo Laravel decide qué generador concreto usar
// Archivo: app/Providers/AppServiceProvider.php
//
// Aquí es donde se "conecta" la interfaz con la implementación concreta.
// El controlador recibe el tipo de reporte como parámetro de la URL
// y Laravel resuelve cuál clase instanciar.

namespace App\Providers;

use App\Contracts\GeneradorReporte;
use App\Reportes\ProgresoPesoReporte;
use App\Reportes\CondicionCorporalReporte;
use App\Reportes\InventarioReporte;
use App\Reportes\ResumenMensualReporte;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // El controlador recibe el tipo como string (ej: 'resumen_mensual')
        // y este mapa resuelve qué clase usar. Solo aquí se toca algo al
        // agregar un nuevo tipo, y es solo agregar una línea al array.
        $this->app->bind(GeneradorReporte::class, function ($app) {
            $tipo = request('tipo');

            $mapa = [
                'progreso_peso'       => ProgresoPesoReporte::class,
                'condicion_corporal'  => CondicionCorporalReporte::class,
                'inventario'          => InventarioReporte::class,
                'resumen_mensual'     => ResumenMensualReporte::class,
                // Para agregar 'reporte_veterinario':
                // 1. Crear app/Reportes/ReporteVeterinarioReporte.php
                // 2. Agregar la línea aquí.
                // ReporteService.php no se toca.
            ];

            $clase = $mapa[$tipo] ?? null;

            if (!$clase) {
                throw new \InvalidArgumentException("Tipo de reporte desconocido: {$tipo}");
            }

            return new $clase();
        });
    }
}