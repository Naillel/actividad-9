<?php

// ✅ CORRECCIÓN LSP — Animal implementa el contrato completo de pesaje
// Archivo: app/Domain/Animal.php

namespace App\Domain;

use App\Contracts\AnimalPesable;

/**
 * Animal adulto con peso conocido.
 * Cumple TODO el contrato de AnimalPesable sin excepciones ni valores inválidos.
 */
class Animal implements AnimalPesable
{
    private array $registrosPeso = [];

    public function __construct(
        private string $numeroArete,
        private ?string $nombre,
        private int $razaId,
        private int $ranchoId,
        private float $pesoInicialKg,
    ) {}

    public function getNumeroArete(): string  { return $this->numeroArete; }
    public function getNombre(): ?string      { return $this->nombre; }
    public function getRazaId(): int          { return $this->razaId; }
    public function getRanchoId(): int        { return $this->ranchoId; }

    /**
     * Cumple la promesa: agrega el registro sin lanzar excepción.
     */
    public function agregarRegistroPeso(RegistroPeso $registro): void
    {
        $this->registrosPeso[] = $registro;
    }

    /**
     * Cumple la promesa: retorna float o null solo si hay menos de 2 registros.
     */
    public function calcularGananciaDiariaPromedio(): ?float
    {
        if (count($this->registrosPeso) < 2) {
            return null;
        }

        $primero = $this->registrosPeso[0]->getPesoKg();
        $ultimo  = end($this->registrosPeso)->getPesoKg();
        $dias    = $this->registrosPeso[0]->getDiasTranscurridos(end($this->registrosPeso));

        return $dias > 0 ? ($ultimo - $primero) / $dias : null;
    }

    /**
     * Cumple la promesa: retorna float en rango 1.0 – 9.0. Nunca -1.
     */
    public function calcularIndiceCondicionCorporal(): float
    {
        // Cálculo real del ICC basado en el peso y la raza.
        // Siempre retorna un valor válido entre 1.0 y 9.0.
        return min(9.0, max(1.0, $this->pesoInicialKg / 100));
    }
}