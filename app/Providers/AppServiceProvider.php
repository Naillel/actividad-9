<?php

namespace App\Providers;

use App\Contracts\PesoEstimadorClientInterface;
use App\Infrastructure\FlaskPesoEstimadorClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Aquí es el ÚNICO lugar del proyecto donde se menciona Flask y la URL.
        // EstimadorPesoService nunca ve esta línea.
        // Para cambiar de Flask a FastAPI: solo se cambia la clase aquí.
        $this->app->bind(PesoEstimadorClientInterface::class, function () {
            return new FlaskPesoEstimadorClient(
                baseUrl: config('services.ml.url', 'http://localhost:5000'),
            );
        });
    }
}