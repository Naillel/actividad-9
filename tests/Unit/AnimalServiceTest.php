<?php

// ✅ BENEFICIO del SRP — prueba unitaria limpia y sin dependencias innecesarias
// Archivo: tests/Unit/AnimalServiceTest.php

namespace Tests\Unit;

use App\Services\AnimalService;
use App\Services\AnimalNotificacionService;
use App\Services\AnimalPdfService;
use PHPUnit\Framework\TestCase;

class AnimalServiceTest extends TestCase
{
    private AnimalService $servicio;

    protected function setUp(): void
    {
        // Creamos mocks SOLO de los servicios delegados, no de Mail ni PDF directamente.
        // AnimalService ya no sabe nada de emails ni de archivos PDF.
        $notificacion = $this->createMock(AnimalNotificacionService::class);
        $pdf          = $this->createMock(AnimalPdfService::class);

        $this->servicio = new AnimalService($notificacion, $pdf);
    }

    /** @test */
    public function lanza_excepcion_si_el_arete_esta_vacio(): void
    {
        // ── Antes (con la clase original): necesitábamos mockear Mail, Pdf, DB, Animal::create
        // ── Ahora: cero mocks adicionales. La prueba es directa y clara.

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('El arete es obligatorio.');

        $this->servicio->registrar([
            'numero_arete'    => '',   // <── esto es lo que estamos probando
            'peso_inicial_kg' => 300,
            'nombre'          => 'Lucera',
            'raza_id'         => 1,
            'rancho_id'       => 1,
            'fecha_nacimiento' => '2022-01-15',
        ]);
    }

    /** @test */
    public function lanza_excepcion_si_el_peso_inicial_es_cero_o_negativo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('El peso inicial debe ser positivo.');

        $this->servicio->registrar([
            'numero_arete'    => 'CR-001-2024',
            'peso_inicial_kg' => 0,   // <── esto es lo que estamos probando
            'nombre'          => 'Lucera',
            'raza_id'         => 1,
            'rancho_id'       => 1,
            'fecha_nacimiento' => '2022-01-15',
        ]);
    }
}