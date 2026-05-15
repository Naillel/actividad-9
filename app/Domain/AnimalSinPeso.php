<?php

// ✅ CORRECCIÓN LSP — AnimalSinPeso solo promete lo que puede cumplir
// Archivo: app/Domain/AnimalSinPeso.php

namespace App\Domain;

use App\Contracts\AnimalRegistrable;

/**
 * Representa un ternero recién nacido cuyo peso aún no se conoce.
 *
 * CORRECCIÓN: ya NO hereda de Animal ni implementa AnimalPesable.
 * Solo implementa AnimalRegistrable, que es lo único que puede cumplir.
 *
 * Ahora es IMPOSIBLE pasar un AnimalSinPeso donde se espera un AnimalPesable.
 * El error que antes explotaba en tiempo de ejecución ahora lo detecta PHP
 * antes de correr el programa.
 */
class AnimalSinPeso implements AnimalRegistrable
{
    public function __construct(
        private string $numeroArete,
        private ?string $nombre,
        private int $razaId,
        private int $ranchoId,
    ) {}

    public function getNumeroArete(): string { return $this->numeroArete; }
    public function getNombre(): ?string     { return $this->nombre; }
    public function getRazaId(): int         { return $this->razaId; }
    public function getRanchoId(): int       { return $this->ranchoId; }

    // No hay agregarRegistroPeso(), no hay calcularGDP(), no hay calcularICC().
    // No los necesita. No los promete. No los rompe.
}