<?php

// ✅ CORRECCIÓN ISP — gestor completo para quien necesita leer Y escribir
// Archivo: app/Services/GestorAnimalService.php

namespace App\Services;

use App\Contracts\IGestorAnimal;
use App\Domain\Animal;
use App\Domain\RegistroPeso;

/**
 * Implementa IGestorAnimal completa (lectura + escritura).
 * Esta es la clase que usa el ganadero Don Iván para gestionar
 * sus animales: registrar, actualizar, eliminar y consultar.
 *
 * ReportadorSoloLectura y GestorAnimalService ahora son independientes.
 * Agregar actualizarRaza() a IAnimalWriter solo afecta a esta clase,
 * nunca a ReportadorSoloLectura.
 */
class GestorAnimalService implements IGestorAnimal
{
    // ── Escritura ─────────────────────────────────────────────────────────

    public function crear(array $datos): Animal
    {
        return Animal::create($datos);
    }

    public function actualizar(int $id, array $datos): Animal
    {
        $animal = Animal::findOrFail($id);
        $animal->update($datos);
        return $animal;
    }

    public function eliminar(int $id): void
    {
        Animal::findOrFail($id)->delete();
    }

    public function agregarRegistroPeso(int $animalId, RegistroPeso $registro): void
    {
        Animal::findOrFail($animalId)->registrosPeso()->save($registro);
    }

    public function asignarFotografia(int $registroId, string $urlFoto): void
    {
        RegistroPeso::findOrFail($registroId)->update(['url_foto' => $urlFoto]);
    }

    // ── Lectura ───────────────────────────────────────────────────────────

    public function buscarPorArete(string $arete): ?Animal
    {
        return Animal::where('numero_arete', $arete)->first();
    }

    public function listarPorRancho(int $ranchoId): array
    {
        return Animal::where('rancho_id', $ranchoId)->get()->toArray();
    }

    public function obtenerHistorialPeso(int $animalId): array
    {
        return Animal::findOrFail($animalId)
            ->registrosPeso()
            ->orderBy('fecha')
            ->get()
            ->toArray();
    }

    public function calcularEstadisticasRancho(int $ranchoId): array
    {
        $animales = Animal::where('rancho_id', $ranchoId)->get();

        return [
            'total_animales' => $animales->count(),
            'peso_promedio'  => $animales->avg('peso_inicial_kg'),
            'peso_maximo'    => $animales->max('peso_inicial_kg'),
            'peso_minimo'    => $animales->min('peso_inicial_kg'),
        ];
    }
}