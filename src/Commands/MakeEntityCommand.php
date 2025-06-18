<?php

namespace Homedeve\Coreflow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeEntityCommand extends Command
{
    protected $signature = 'coreflow:make:entity {name : Nom de l\'entité et du contexte (ex: User)}';
    protected $description = 'Crée une entité métier dans src/Domain/{Context}/Entities avec la structure DDD.';

    public function handle(): int
    {
        $context = Str::studly(trim($this->argument('name'))); // ex: User
        $entityName = $context; // Le nom de l’entité est le même que le contexte

        $basePath = base_path("src/Domain/{$context}");
        $entityDir = "{$basePath}/Entities";
        $valueObjectDir = "{$basePath}/ValueObjects";
        $repositoryDir = "{$basePath}/Repositories";

        // 1. Créer les dossiers du contexte
        foreach ([$entityDir, $valueObjectDir, $repositoryDir] as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
                $this->line("📁 Dossier créé : $dir");
            }
        }

        // 2. Création de l'entité dans Entities/
        $className = $entityName;
        $namespace = "App\\Src\\Domain\\{$context}\\Entities";
        $path = "{$entityDir}/{$className}.php";

        if (File::exists($path)) {
            $this->error("❌ L'entité {$className} existe déjà dans le contexte {$context}.");
            return Command::FAILURE;
        }

        $template = <<<PHP
<?php

namespace $namespace;

class $className
{
    // TODO : propriétés et méthodes métier
}
PHP;

        File::put($path, $template);

        $this->info("✅ Entité {$className} générée dans src/Domain/{$context}/Entities.");
        return Command::SUCCESS;
    }
}
