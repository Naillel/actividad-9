<?php

namespace App\Services;

use App\Models\Animal;
use App\Services\AnimalNotificacionService;
use App\Services\AnimalPdfService;

class AnimalService
{
    public function __construct(
        private AnimalNotificacionService $notificacionService,
        private AnimalPdfService $pdfService,
    ) {}

public function registrar(array $datos): Animal{

        if (empty($datos['numero_arete'])) {
            throw new \InvalidArgumentException('El arete es obligatorio.');
        }

        if ($datos['peso_inicial_kg'] <= 0) {
            throw new \InvalidArgumentException('El peso inicial debe ser positivo.');
        }

        $animal = Animal::create([
            'numero_arete'    => $datos['numero_arete'],
            'nombre'          => $datos['nombre'],
            'raza_id'         => $datos['raza_id'],
            'rancho_id'       => $datos['rancho_id'],
            'peso_inicial_kg' => $datos['peso_inicial_kg'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'],
        ]);

        $this->notificacionService->notificarRegistro($animal);
        $this->pdfService->generarRegistro($animal);

        return $animal;
    }
}