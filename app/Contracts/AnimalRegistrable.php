<?php

// ✅ CORRECCIÓN LSP — interfaz base con solo lo que todo animal tiene
// Archivo: app/Contracts/AnimalRegistrable.php

namespace App\Contracts;

/**
 * Contrato mínimo que cualquier animal cumple,
 * sin importar si puede pesarse o no.
 */
interface AnimalRegistrable
{
    public function getNumeroArete(): string;
    public function getNombre(): ?string;
    public function getRazaId(): int;
    public function getRanchoId(): int;
}