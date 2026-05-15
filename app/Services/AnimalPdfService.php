<?php

// ✅ CORRECCIÓN SRP — responsabilidad única: generación del PDF de registro
// Archivo: app/Services/AnimalPdfService.php

namespace App\Services;

use App\Models\Animal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class AnimalPdfService
{
public function generarRegistro(Animal $animal): void{$propietario = DB::table('propietarios')->where('rancho_id', $animal->rancho_id)->first();

        $pdf = Pdf::loadView('reportes.registro_animal', [
            'animal'      => $animal,
            'propietario' => $propietario,
            'fecha'       => now()->format('d/m/Y H:i'),
        ]);

        $rutaPdf = 'registros/' . $animal->numeroarete . '' . now()->timestamp . '.pdf';
        $pdf->save(storage_path('app/public/' . $rutaPdf));

        $animal->update(['ruta_pdf_registro' => $rutaPdf]);
    }
}