<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * -------------------------------------------------------------
 * MakeService Command
 * -------------------------------------------------------------
 *
 * Generate Service inside:
 * app/Services
 *
 * Usage:
 *   php artisan make:service UserService
 *
 */

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create Service';

    public function handle()
    {
        $name = $this->argument('name');

        if (!str_ends_with($name, 'Service')) {
            $name .= 'Service';
        }

        $path = app_path("Services/{$name}.php");

        if (File::exists($path)) {
            $this->components->error("Service [{$name}] already exists.");
            return;
        }

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $this->template($name));

        $this->components->info("Service [{$name}] created successfully.");
    }

    private function template(string $name): string
    {
        return "<?php

namespace App\Services;

class {$name}
{
    /**
     * Get all records.
     */
    public function getAll()
    {
        //
    }

    /**
     * Get record by ID.
     */
    public function getById(\$id)
    {
        //
    }

    /**
     * Store a newly created record.
     */
    public function create(array \$data)
    {
        //
    }

    /**
     * Update the specified record.
     */
    public function update(\$id, array \$data)
    {
        //
    }

    /**
     * Remove the specified record.
     */
    public function delete(\$id)
    {
        //
    }
}
";
    }
}