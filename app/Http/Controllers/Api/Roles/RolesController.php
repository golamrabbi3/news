<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => __('Fetched roles successfully.'),
            'data' => Role::orderByDesc('created_at')->all(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permission);

        return response()->json([
            'message' => __('The role has been created successfully.'),
            'data' => [
                'role' => $role,
                'permissions' => $role->permissions,
            ],
        ]);
    }

    public function show(Role $role): JsonResponse
    {
        return response()->json([
            'message' => __("Fetched role's permissions successfully."),
            'data' => [
                'role' => $role,
                'permissions' => $role->permissions,
            ],
        ]);
    }

    public function update(Role $role, Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));
        $role->syncPermissions($request->permission);

        return response()->json([
            'message' => __("The role has been updated successfully."),
        ]);
    }

    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return response()->json([
            'message' => __("The role has been deleted successfully."),
        ]);
    }
}
