<?php

namespace Homedeve\Coreflow\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'coreflow:make:repository {context : Nom du contexte métier (ex: User)}';
    protected $description = 'Crée un Repository dans un contexte DDD : interface + implémentation Eloquent.';

    public function handle(): int
    {
        $context = Str::studly(trim($this->argument('context')));
        $interfaceName = "{$context}RepositoryInterface";
        $implName = "Eloquent{$context}Repository";

        // Noms de namespace
        $domainNamespace = "Domain\\{$context}\\Repositories";
        $infraNamespace = "Infrastructure\\Persistence\\{$context}";

        // Répertoires
        $interfaceDir = base_path("src/Domain/{$context}/Repositories");
        $implDir = base_path("src/Infrastructure/Persistence/{$context}");

        if (!File::exists($interfaceDir)) {
            File::makeDirectory($interfaceDir, 0755, true);
        }

        if (!File::exists($implDir)) {
            File::makeDirectory($implDir, 0755, true);
        }

        $interfacePath = "$interfaceDir/{$interfaceName}.php";
        $implPath = "$implDir/{$implName}.php";

        if (File::exists($interfacePath)) {
            $this->error("❌ L'interface {$interfaceName} existe déjà.");
            return Command::FAILURE;
        }

        if (File::exists($implPath)) {
            $this->error("❌ L'implémentation {$implName} existe déjà.");
            return Command::FAILURE;
        }

        // Générer interface
        File::put($interfacePath, <<<PHP
<?php

namespace $domainNamespace;

interface $interfaceName
{
    // Déclarez ici les signatures des méthodes
}
PHP);

        // Générer implémentation
        File::put($implPath, <<<PHP
<?php

namespace $infraNamespace;

use $domainNamespace\\$interfaceName;

class $implName implements $interfaceName
{
    // Implémentez ici les méthodes de l’interface
}
PHP);

        $this->info("✅ Interface créée : $interfacePath");
        $this->info("✅ Implémentation créée : $implPath");

        return Command::SUCCESS;
    }
}
