<?php


namespace App\Infrastructure;

use App\Contracts\PesoEstimadorClientInterface;
use Illuminate\Support\Facades\Http;

class FlaskPesoEstimadorClient implements PesoEstimadorClientInterface
{
    public function __construct(
        private string $baseUrl = 'http://localhost:5000',
    ) {}

    public function estimarPeso(array $urlsFotos, string $raza, int $edadMeses): array
    {
        $respuesta = Http::timeout(30)
            ->post($this->baseUrl . '/estimate', [
                'image_urls' => $urlsFotos,
                'breed'      => $raza,
                'age_months' => $edadMeses,
            ]);

        if (!$respuesta->successful()) {
            throw new \RuntimeException('El servicio de estimación ML no respondió correctamente.');
        }

        return $respuesta->json();
    }
}