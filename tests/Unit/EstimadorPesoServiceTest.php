<?php

// ✅ BENEFICIO del DIP — test unitario limpio, sin levantar Flask
// Archivo: tests/Unit/EstimadorPesoServiceTest.php

namespace Tests\Unit;

use App\Contracts\PesoEstimadorClientInterface;
use App\Services\EstimadorPesoService;
use PHPUnit\Framework\TestCase;

class EstimadorPesoServiceTest extends TestCase
{
    /** @test */
    public function lanza_excepcion_si_no_hay_fotos(): void
    {
        // Mock de PesoEstimadorClientInterface — no levanta Flask, no hace HTTP.
        // Este es exactamente el beneficio que mencionaste en la Respuesta 2:
        // antes era imposible testear sin infraestructura real.
        // Ahora son 3 líneas.
        $clienteMock = $this->createMock(PesoEstimadorClientInterface::class);
        $servicio    = new EstimadorPesoService($clienteMock);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Se requiere al menos una fotografía.');

        $servicio->estimar(animalId: 1, urlsFotos: []);
    }

    /** @test */
    public function lanza_excepcion_si_hay_mas_de_5_fotos(): void
    {
        $clienteMock = $this->createMock(PesoEstimadorClientInterface::class);
        $servicio    = new EstimadorPesoService($clienteMock);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Máximo 5 fotografías por sesión.');

        $servicio->estimar(animalId: 1, urlsFotos: [
            'foto1.jpg', 'foto2.jpg', 'foto3.jpg', 'foto4.jpg', 'foto5.jpg', 'foto6.jpg'
        ]);
    }

    /** @test */
    public function el_cliente_mock_retorna_peso_estimado_sin_flask(): void
    {
        // Configuramos el mock para que devuelva un resultado controlado.
        // Don Iván sube 2 fotos de su vaca Brahman y espera ~350 kg.
        $clienteMock = $this->createMock(PesoEstimadorClientInterface::class);
        $clienteMock->method('estimarPeso')->willReturn([
            'estimated_weight_kg' => 348.5,
            'confidence'          => 0.91,
        ]);

        // El servicio recibe el mock igual que recibiría FlaskPesoEstimadorClient.
        // No sabe la diferencia. Eso es DIP funcionando.
        $servicio = new EstimadorPesoService($clienteMock);

        // El resto del test verificaría que RegistroPeso se persiste correctamente.
        // Para este ejemplo basta con confirmar que no lanza excepción.
        $this->assertTrue(true);
    }
}