<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * -------------------------------------------------------------
 * MakeInterface Command
 * -------------------------------------------------------------
 *
 * Generate Repository Interface inside:
 * app/Interfaces
 *
 * Usage:
 *   php artisan make:irepo UserRepositoryInterface
 *
 */

class MakeInterface extends Command
{
    protected $signature = 'make:irepo {name}';
    protected $description = 'Create Repository Interface';

    public function handle()
    {
        $name          = $this->argument('name');

        if (!str_ends_with($name, 'RepositoryInterface')) {
            $name .= 'RepositoryInterface';
        }

        $path          = app_path("Interfaces/{$name}.php");

        if (File::exists($path)) {
            $this->components->error("Interface [{$name}] already exists.");
            return;
        }

        File::ensureDirectoryExists(dirname($path));

        File::put($path, "<?php

namespace App\Interfaces;

interface {$name}
{
    /**
     * Get all records with related data.
     */
    public function getAll();

    /**
     * Search by keyword.
     */
    public function search(string \$keyword);

    /**
     * Create a new record.
     */
    public function create(array \$data);

    /**
     * Update an existing record by ID.
     */
    public function update(\$id, array \$data);

    /**
     * Delete a record by ID.
     */
    public function delete(\$id);
}
");

        $this->components->info("Interface [{$name}] created successfully.");
    }
}