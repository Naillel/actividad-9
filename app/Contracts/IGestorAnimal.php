<?php


namespace App\Contracts;


interface IGestorAnimal extends IAnimalReader, IAnimalWriter
{
    // No agrega métodos nuevos.
    // Es solo la combinación formal de las dos interfaces cohesivas.
}