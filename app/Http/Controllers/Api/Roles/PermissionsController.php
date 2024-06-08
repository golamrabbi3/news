<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class PermissionsController extends Controller
{
    public function __invoke(): JsonResponse
    {
        try {
            Artisan::call("permission:create");

            return response()->json([
                'message' => __('All permissions are synchronized successfully.'),
                'data' => Permission::get(),
            ]);
        } catch(Throwable $e) {
            report($e);

            return response()->json([
                'message' => __('Failed to synchronize permissions! Please try again.'),
            ]);
        }
    }
}
