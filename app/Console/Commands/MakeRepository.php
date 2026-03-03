<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * -------------------------------------------------------------
 * MakeRepository Command
 * -------------------------------------------------------------
 *
 * Generate Repository inside:
 * app/Repositories
 *
 * Usage:
 *   php artisan make:repo UserRepository
 *
 */

class MakeRepository extends Command
{
    protected $signature = 'make:repo {name}';
    protected $description = 'Create Repository';

    public function handle()
    {
        $name           = $this->argument('name');
        
        if (!str_ends_with($name, 'Repository')) {
            $name .= 'Repository';
        }

        $modelName = str_replace('Repository', '', $this->argument('name'));
        $interfaceName  = $name . 'Interface';

        $path = app_path("Repositories/{$name}.php");

        if (File::exists($path)) {
            $this->components->error("Repository [{$name}] already exists.");
            return;
        }

        File::ensureDirectoryExists(dirname($path));

        File::put($path, "<?php

namespace App\Repositories;

use App\Interfaces\\{$interfaceName};
use App\Models\\{$modelName};

class {$name} implements {$interfaceName}
{
    public function __construct(
        private {$modelName} \$model
    ) {}

    /**
     * Get all records with related data.
     */
    public function getAll()
    {
        //
    }

    /**
     * Search by keyword.
     */
    public function search(string \$keyword)
    {
        //
    }

    /**
     * Create a new record.
     */
    public function create(array \$data)
    {
        //
    }

    /**
     * Update an existing record by ID.
     */
    public function update(\$id, array \$data)
    {
        //
    }

    /**
     * Delete a record by ID.
     */
    public function delete(\$id)
    {
        //
    }
}
");

        $this->components->info("Repository [{$name}] created successfully.");
    }
}