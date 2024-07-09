<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Roles\RoleRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => __('Fetched roles successfully.'),
            'data' => Role::orderByDesc('created_at')->get(),
        ]);
    }

    public function store(RoleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'api',
            ]);
            $role->syncPermissions($request->permissions);
            DB::commit();

            return response()->json([
                'message' => __('The role has been created successfully.'),
                'data' => $role->load('permissions'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
        }

        return response()->json([
            'message' => __('Failed to create the role! Please try again.'),
        ], 400);
    }

    public function show(Role $role): JsonResponse
    {
        return response()->json([
            'message' => __("Fetched role's permissions successfully."),
            'data' => $role->load('permissions'),
        ]);
    }

    public function update(Role $role, RoleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            if (!$role->update($request->only('name'))) {
                throw new Exception(__("Failed to update the role name!"));
            }
            $role->syncPermissions($request->permissions);
            DB::commit();

            return response()->json([
                'message' => __("The role has been updated successfully."),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
        }

        return response()->json([
            'message' => __('Failed to update the role! Please try again.'),
        ], 400);
    }

    public function destroy(Role $role): JsonResponse
    {
        try {
            if ($role->delete()) {
                return response()->json([
                    'message' => __("The role has been deleted successfully."),
                ]);
            }
        } catch (Exception $e) {
            report($e);
        }

        return response()->json([
            'message' => __("Failed to delete the role! Please try again."),
        ], 400);
    }
}
