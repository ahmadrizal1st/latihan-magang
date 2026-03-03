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
 *   php artisan make:service EmployeeService
 *
 */

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create Service';

    public function handle()
    {
        $name = $this->argument('name');
        $interfaceName = $name . 'RepositoryInterface';
        $serviceName = $name . 'Service';

        $path = app_path("Services/{$serviceName}.php");
        File::ensureDirectoryExists(dirname($path));

        File::put($path, "<?php

namespace App\Services;

use App\Interfaces\\{$interfaceName};

/**
 * Class {$serviceName}
 *
 * Handle business logic for {$name}.
 */
class {$serviceName}
{
    /**
     * Repository instance.
     *
     * @var {$interfaceName}
     */
    protected \$repository;

    /**
     * Constructor.
     *
     * @param {$interfaceName} \$repository
     */
    public function __construct({$interfaceName} \$repository)
    {
        \$this->repository = \$repository;
    }

    /**
     * Get all {$name}.
     */
    public function getAll()
    {
        return \$this->repository->getAll();
    }

    /**
     * Get {$name} by ID.
     */
    public function getById(\$id)
    {
        return \$this->repository->getById(\$id);
    }

    /**
     * Create new {$name}.
     */
    public function create(array \$data)
    {
        return \$this->repository->create(\$data);
    }

    /**
     * Update {$name}.
     */
    public function update(\$id, array \$data)
    {
        return \$this->repository->update(\$id, \$data);
    }

    /**
     * Delete {$name}.
     */
    public function delete(\$id)
    {
        return \$this->repository->delete(\$id);
    }
}
");

        $this->info("Service created successfully.");
    }
}