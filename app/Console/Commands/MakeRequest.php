<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * -------------------------------------------------------------
 * MakeRequest Command
 * -------------------------------------------------------------
 *
 * Generate Store & Update Request inside:
 * app/Http/Requests/{Name}
 *
 * Usage:
 *   php artisan make:req Employee su
 *
 * -------------------------------------------------------------
 * Available Flags:
 * -------------------------------------------------------------
 *
 * s = Store Request
 * u = Update Request
 *
 */

class MakeRequest extends Command
{
    protected $signature   = 'make:req {name} {flags?}';
    protected $description = 'Create Store and/or Update request inside folder';

    public function handle()
    {
        $name  = $this->argument('name');
        $flags = $this->argument('flags') ?? 'su';

        if (str_contains($flags, 's')) {
            Artisan::call('make:request', ['name' => "{$name}/Store{$name}Request"]);
            $this->components->info("Store{$name}Request created successfully.");
        }

        if (str_contains($flags, 'u')) {
            Artisan::call('make:request', ['name' => "{$name}/Update{$name}Request"]);
            $this->components->info("Update{$name}Request created successfully.");
        }
    }
}