<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;

class PermissionsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => __('Fetched all permissions successfully.'),
            'data' => Permission::get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        $permission = Permission::create($request->only('name'));

        return response()->json([
            'message' => __('The permission has been created successfully.'),
            'data' => [
                'permission' => $permission,
            ],
        ]);
    }

    public function update(Request $request, Permission $permission): JsonResponse
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id
        ]);

        $permission->update($request->only('name'));

        return response()->json([
            'message' => __('The permission has been created successfully.'),
        ]);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json([
            'message' => __("The permission has been deleted successfully."),
        ]);
    }
}
