<?php


namespace App\Services;

use App\Contracts\GeneradorReporte;

class ReporteService
{
    public function __construct(
        private GeneradorReporte $generador,
    ) {}

public function generar(int $ranchoId): array{
    return $this->generador->generar($ranchoId);}
}