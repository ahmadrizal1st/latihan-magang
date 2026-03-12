<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * -------------------------------------------------------------
 * MakeApiController Command
 * -------------------------------------------------------------
 *
 * Generate API Controller inside:
 * app/Http/Controllers/Api
 *
 * Usage:
 *   php artisan make:conapi UserController
 *
 */

class MakeApiController extends Command
{
    protected $signature = 'make:conapi {name}';
    protected $description = 'Create API Controller inside Api folder';

    public function handle()
    {
        $name = $this->argument('name');

        if (!str_ends_with($name, 'Controller')) {
            $name .= 'Controller';
        }

        Artisan::call('make:controller', [
            'name' => 'Api/' . $name,
            '--api' => true
        ]);

        $this->components->info("API Controller created successfully.");
    }
}