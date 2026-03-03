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
 *   php artisan make:repo EmployeeRepository
 *
 */

class MakeRepository extends Command
{
    protected $signature = 'make:repo {name}';
    protected $description = 'Create Repository';

    public function handle()
    {
        $name = $this->argument('name');
        $interfaceName = $name . 'RepositoryInterface';
        $repositoryName = $name . 'Repository';

        $path = app_path("Repositories/{$repositoryName}.php");
        File::ensureDirectoryExists(dirname($path));

        File::put($path, "<?php

namespace App\Repositories;

use App\Models\\{$name};
use App\Interfaces\\{$interfaceName};

/**
 * Class {$repositoryName}
 *
 * Handle all database interactions for {$name}.
 */
class {$repositoryName} implements {$interfaceName}
{
    /**
     * The {$name} model instance.
     *
     * @var {$name}
     */
    protected \$model;

    /**
     * Constructor.
     *
     * @param {$name} \$model
     */
    public function __construct({$name} \$model)
    {
        \$this->model = \$model;
    }

    /**
     * Get all {$name} records with related data.
     */
    public function getAll()
    {
        return \$this->model->latest()->get();
    }

    /**
     * Get {$name} by ID.
     */
    public function getById(\$id)
    {
        return \$this->model->findOrFail(\$id);
    }

    /**
     * Search {$name} by keyword.
     */
    public function search(string \$keyword)
    {
        return \$this->model
            ->where('name', 'like', \"%{\$keyword}%\")
            ->get();
    }

    /**
     * Store new {$name}.
     */
    public function create(array \$data)
    {
        return \$this->model->create(\$data);
    }

    /**
     * Update {$name} by ID.
     */
    public function update(\$id, array \$data)
    {
        \$record = \$this->getById(\$id);
        \$record->update(\$data);
        return \$record;
    }

    /**
     * Delete {$name} by ID.
     */
    public function delete(\$id)
    {
        return \$this->model->destroy(\$id);
    }
}
");

        $this->info("Repository created successfully.");
    }
}