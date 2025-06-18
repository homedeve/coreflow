<?php

namespace Homedeve\Coreflow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'coreflow:install';
    protected $description = 'Génère la structure DDD + Clean Architecture dans un projet Laravel (sans Bounded Contexts prématurés).';

    public function handle(): int
    {
        $this->info('🛠 Initialisation de la structure Clean Architecture...');

        // Racine métier
        $directories = [
            'src/Domain',              // Bounded Contexts (User, Product, etc.)
            'src/Application',         // UseCases, Services, etc. spécifiques à un domaine
            'src/Infrastructure',      // Couche d’accès externe (Persistance, Mail, PDF, etc.)
            'src/Shared/Interfaces',   // Interfaces transversales, ex : Logger, EventDispatcher
            'src/Shared/Exceptions'    // Exceptions génériques métier
        ];

        foreach ($directories as $dir) {
            $path = base_path($dir);
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
                $this->line("📁 Dossier créé : $dir");
            } else {
                $this->warn("⚠️ Déjà existant : $dir");
            }
        }

        $this->info('✅ Structure DDD + Clean Architecture initialisée avec succès.');
        return Command::SUCCESS;
    }
}
