<?php

namespace Homedeve\Coreflow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'coreflow:install';
    protected $description = 'Génère la structure DDD + Clean Architecture dans un projet Laravel.';

    public function handle(): int
    {
        $this->info('🛠 Création de la structure Clean Architecture...');

        $directories = [
            'core/Domain/Entities',
            'core/Domain/Repositories',
            'core/Domain/ValueObjects',
            'core/Application/DTOs',
            'core/Application/UseCases',
            'core/Application/Services',
            'core/Shared/Interfaces',
            'core/Shared/Exceptions',
            'infrastructure/Persistence/Eloquent',
            'infrastructure/Notifications',
            'infrastructure/Pdf',
            'infrastructure/Services'
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

        $this->info('✅ Structure générée avec succès !');
        return Command::SUCCESS;
    }
}
