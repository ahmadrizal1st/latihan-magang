<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * -------------------------------------------------------------
 * MakeWebController Command
 * -------------------------------------------------------------
 *
 * Generate Web Controller (Resource) inside:
 * app/Http/Controllers/Web
 *
 * Usage:
 *   php artisan make:conweb UserController
 *
 */

class MakeWebController extends Command
{
    protected $signature = 'make:conweb {name}';
    protected $description = 'Create Web Resource Controller inside Web folder';

    public function handle()
    {
        $name = $this->argument('name');

        if (!str_ends_with($name, 'Controller')) {
            $name .= 'Controller';
        }

        Artisan::call('make:controller', [
            'name' => 'Web/' . $name,
            '--resource' => true
        ]);

        $this->components->info("Web Controller created successfully.");
    }
}