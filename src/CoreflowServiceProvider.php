<?php

namespace Homedeve\Coreflow;

use Illuminate\Support\ServiceProvider;

use Homedeve\Coreflow\Commands\InstallCommand;
use Homedeve\Coreflow\Commands\MakeEntityCommand;

class CoreflowServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Chargement des commandes personnalisées Artisan
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                MakeEntityCommand::class,
                // D'autres commandes seront ajoutées ici
            ]);
        }

        // Publication des stubs à personnaliser
        $this->publishes([
            __DIR__ . '/../stubs' => base_path('stubs/coreflow'),
        ], 'coreflow-stubs');
    }

    public function register(): void
    {
        //binder des services ici
    }
}
