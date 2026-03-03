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
 *   php artisan make:irepo EmployeeRepositoryInterface
 *
 */

class MakeInterface extends Command
{
    protected $signature = 'make:irepo {name}';
    protected $description = 'Create Repository Interface';

    public function handle()
    {
        
        $name = $this->argument('name');
        $interfaceName = $name . 'RepositoryInterface';
        $repositoryName = $name . 'Repository';

        $path = app_path("Repositories/{$repositoryName}.php");
        File::ensureDirectoryExists(dirname($path));

        File::put($path, "<?php

namespace App\Interfaces;

/**
 * Interface {$interfaceName}
 *
 * Contract for {$name} data access layer.
 */
interface {$interfaceName}
{
    /**
     * Get all {$name} records with related data.
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get {$name} by ID with related data.
     *
     * @param int \$id
     * @return mixed
     */
    public function getById(\$id);

    /**
     * Search {$name} by keyword.
     *
     * @param string \$keyword
     * @return mixed
     */
    public function search(string \$keyword);

    /**
     * Store new {$name} data.
     *
     * @param array \$data
     * @return mixed
     */
    public function create(array \$data);

    /**
     * Update {$name} data by ID.
     *
     * @param int \$id
     * @param array \$data
     * @return mixed
     */
    public function update(\$id, array \$data);

    /**
     * Delete {$name} by ID.
     *
     * @param int \$id
     * @return mixed
     */
    public function delete(\$id);
}
");

        $this->info("Interface created successfully.");
    }
}