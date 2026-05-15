<?php

namespace App\Contracts;

use App\Domain\Animal;
use App\Domain\RegistroPeso;

interface IAnimalWriter
{
    public function crear(array $datos): Animal;
    public function actualizar(int $id, array $datos): Animal;
    public function eliminar(int $id): void;
    public function agregarRegistroPeso(int $animalId, RegistroPeso $registro): void;
    public function asignarFotografia(int $registroId, string $urlFoto): void;
}