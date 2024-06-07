<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Route Permission';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            if ($route->getName() && in_array('permission', $route->getAction()['middleware'])) {
                Permission::firstOrCreate(['name' => $route->getName()],['guard_name' => 'api']);
            }
        }

        $this->info('Permission routes added successfully.');
    }
}
