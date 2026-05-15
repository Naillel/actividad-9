<?php

// ✅ CORRECCIÓN OCP — abstracción que permite extender sin modificar
// Archivo: app/Contracts/GeneradorReporte.php

namespace App\Contracts;

interface GeneradorReporte
{
  
public function generar(int $ranchoId): array;
}