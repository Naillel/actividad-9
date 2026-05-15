<?php

// ✅ CORRECCIÓN LSP — el controlador ahora es seguro por diseño
// Archivo: app/Http/Controllers/PesoController.php

namespace App\Http\Controllers;

use App\Contracts\AnimalPesable;
use App\Domain\RegistroPeso;

class PesoController extends Controller
{
    /**
     * ANTES (con la violación):
     *   public function registrarPeso(Animal $animal, array $datos): void
     *   El tipo Animal no garantizaba nada. Si llegaba un AnimalSinPeso → BOOM.
     *
     * AHORA (con LSP aplicado):
     *   El tipo AnimalPesable garantiza que agregarRegistroPeso() funciona.
     *   PHP rechaza en tiempo de compilación cualquier objeto que no
     *   implemente AnimalPesable — incluyendo AnimalSinPeso.
     *
     *   El Dr. Solano puede usar este método con confianza total.
     */
    public function registrarPeso(AnimalPesable $animal, array $datos): void
    {
        $registro = new RegistroPeso(
            pesoKg: $datos['peso_kg'],
            fecha:  now(),
            metodo: $datos['metodo'] ?? 'bascula',
        );

        // Esto SIEMPRE funciona porque AnimalPesable lo garantiza.
        // No hay instanceof, no hay try/catch, no hay sorpresas.
        $animal->agregarRegistroPeso($registro);
    }
}