<?php

namespace Homedeve\Coreflow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeEntityCommand extends Command
{
    protected $signature = 'coreflow:make:entity {name : Nom de l\'entité}';
    protected $description = 'Crée une nouvelle entité métier dans core/Domain/Entities';

    public function handle(): int
    {
        $name = trim($this->argument('name'));
        $className = Str::studly($name);
        $namespace = 'App\\Core\\Domain\\Entities';
        $directory = base_path('core/Domain/Entities');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $path = "$directory/{$className}.php";

        if (File::exists($path)) {
            $this->error("❌ L'entité {$className} existe déjà.");
            return Command::FAILURE;
        }

        $template = <<<PHP
<?php

namespace $namespace;

class $className
{
    // TODO : Ajout des propriétés et méthodes ici
}
PHP;

        File::put($path, $template);

        $this->info("✅ Entité {$className} créée dans core/Domain/Entities.");
        return Command::SUCCESS;
    }
}
