<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    /**
     * -------------------------------------------------------------
     * MakeModule Artisan Command
     * -------------------------------------------------------------
     *
     * This command generates a full module structure including:
     *
     * - Model
     * - Migration
     * - Seeder
     * - Web Controller (Resource)
     * - API Controller
     * - Form Requests (Store & Update)
     * - Repository Interface
     * - Repository Implementation
     * - Service Layer
     *
     * -------------------------------------------------------------
     * Usage:
     * -------------------------------------------------------------
     *
     * Generate full package:
     *
     *   php artisan make:module User mscripv
     *
     * Generate partial package:
     *
     *   php artisan make:module User cr
     *   php artisan make:module User msv
     *
     * -------------------------------------------------------------
     * Available Flags:
     * -------------------------------------------------------------
     *
     * m = migration
     * s = seeder
     * c = controller (web + api)
     * r = request (Store & Update) -> inside folder:
     *     app/Http/Requests/{ModuleName}
     *
     * i = Repository Interface
     * p = Repository
     * v = Service
     *
     * -------------------------------------------------------------
     * Example Output Structure (User):
     * -------------------------------------------------------------
     *
     * app/
     * ├── Models/User.php
     * ├── Interfaces/UserRepositoryInterface.php
     * ├── Repositories/UserRepository.php
     * ├── Services/UserService.php
     * ├── Http/
     * │   ├── Controllers/UserController.php
     * │   ├── Controllers/Api/UserController.php
     * │   └── Requests/User/
     * │       ├── StoreUserRequest.php
     * │       └── UpdateUserRequest.php
     *
     * -------------------------------------------------------------
     * Notes:
     * -------------------------------------------------------------
     *
     * - Model is always generated.
     * - Flags are optional but recommended.
     * - You must manually bind the interface in AppServiceProvider.
     *
     */

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name} {flags?}';

    /**
     * The console command description.
     *
     * @var string
     */
    
    protected $description = 'Generate full module (model, migration, seeder, controller, request, interface, repository, service)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $flags = $this->argument('flags') ?? '';

        // Always create model
        Artisan::call('make:model', ['name' => $name]);
        $this->info("Model created.");

        if (str_contains($flags, 'm')) {
            Artisan::call('make:migration', [
                'name' => 'create_' . strtolower($name) . 's_table',
                '--create' => strtolower($name) . 's'
            ]);
            $this->info("Migration created.");
        }

        if (str_contains($flags, 's')) {
            Artisan::call('make:seeder', [
                'name' => $name . 'Seeder'
            ]);
            $this->info("Seeder created.");
        }

        if (str_contains($flags, 'c')) {

            // Web Controller inside Web folder
            Artisan::call('make:controller', [
                'name' => 'Web/' . $name . 'Controller',
                '--resource' => true
            ]);

            // API Controller inside Api folder
            Artisan::call('make:controller', [
                'name' => 'Api/' . $name . 'Controller',
                '--api' => true
            ]);

            $this->info("Web and API Controllers created inside respective folders.");
        }

        if (str_contains($flags, 'r')) {

            $requestPath = "Http/Requests/{$name}";

            Artisan::call('make:request', [
                'name' => "{$requestPath}/Store{$name}Request"
            ]);

            Artisan::call('make:request', [
                'name' => "{$requestPath}/Update{$name}Request"
            ]);

            $this->info("Requests created inside folder {$name}.");
        }

        if (str_contains($flags, 'i')) {
            $this->createInterface($name);
        }

        if (str_contains($flags, 'p')) {
            $this->createRepository($name);
        }

        if (str_contains($flags, 'v')) {
            $this->createService($name);
        }

        $this->info("Module {$name} generated successfully");
    }

    private function createInterface($name)
    {
        $interfaceName = $name . 'RepositoryInterface';
        $path = app_path("Interfaces/{$interfaceName}.php");

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

        $this->info("Interface created.");
    }

    private function createRepository($name)
    {
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

        $this->info("Repository created.");
    }

    private function createService($name)
    {
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

        $this->info("Service created.");
    }
}