<?php

namespace Homedeve\Coreflow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'coreflow:make:repository {name : Nom de la ressource}';
    protected $description = 'Crée une interface Repository métier et son implémentation Eloquent';

    public function handle(): int
    {
        $name = trim($this->argument('name'));
        $className = Str::studly($name);
        $interfaceName = "{$className}RepositoryInterface";
        $implClassName = "Eloquent{$className}Repository";

        $domainNamespace = 'App\\Core\\Domain\\Repositories';
        $infraNamespace = 'App\\Infrastructure\\Persistence\\Eloquent';

        $domainDir = base_path('core/Domain/Repositories');
        $infraDir = base_path('infrastructure/Persistence/Eloquent');

        if (!File::exists($domainDir)) {
            File::makeDirectory($domainDir, 0755, true);
        }

        if (!File::exists($infraDir)) {
            File::makeDirectory($infraDir, 0755, true);
        }

        $interfacePath = "$domainDir/{$interfaceName}.php";
        $implPath = "$infraDir/{$implClassName}.php";

        if (File::exists($interfacePath)) {
            $this->error("❌ L'interface {$interfaceName} existe déjà.");
            return Command::FAILURE;
        }

        if (File::exists($implPath)) {
            $this->error("❌ L'implémentation {$implClassName} existe déjà.");
            return Command::FAILURE;
        }

        // Créer l’interface
        File::put($interfacePath, <<<PHP
<?php

namespace $domainNamespace;

interface $interfaceName
{
    // Déclarez ici les signatures des méthodes
}
PHP);

        // Créer l’implémentation
        File::put($implPath, <<<PHP
<?php

namespace $infraNamespace;

use $domainNamespace\\$interfaceName;

class $implClassName implements $interfaceName
{
    // Implémentez ici les méthodes de l’interface
}
PHP);

        $this->info("✅ Interface créée : $interfacePath");
        $this->info("✅ Implémentation créée : $implPath");

        return Command::SUCCESS;
    }
}
