<?php

// ✅ CORRECCIÓN LSP — interfaz extendida solo para animales que pueden pesarse
// Archivo: app/Contracts/AnimalPesable.php

namespace App\Contracts;

use App\Domain\RegistroPeso;

/**
 * Contrato para animales con historial de peso.
 * Solo Animal (adulto con peso conocido) implementa esta interfaz.
 * AnimalSinPeso nunca la implementa, por lo que nunca puede
 * pasarse donde se espera un AnimalPesable.
 */
interface AnimalPesable extends AnimalRegistrable
{
    /**
     * Agrega un registro de peso al historial del animal.
     * Garantía: nunca lanza excepción por el hecho de ser llamado.
     */
    public function agregarRegistroPeso(RegistroPeso $registro): void;

    /**
     * Retorna la ganancia diaria promedio en kg.
     * Garantía: retorna float, o null solo si hay menos de 2 registros.
     */
    public function calcularGananciaDiariaPromedio(): ?float;

    /**
     * Retorna el índice de condición corporal.
     * Garantía: retorna un float válido en el rango 1.0 – 9.0. Nunca -1.
     */
    public function calcularIndiceCondicionCorporal(): float;
}