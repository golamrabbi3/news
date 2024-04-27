<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\ProfileRequest;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use MediaPath;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        $data = request()->user()->only(['name', 'email', 'created_at', 'updated_at']);
        $data['avatar'] = request()->user()->avatar?->path;

        return response()->json([
            'message' => __('Fetched profile information successfully.'),
            'data' => $data,
        ]);
    }

    public function update(ProfileRequest $request): JsonResponse
    {
        if ($request->user()->update($request->validated())) {
            if ($request->hasFile('avatar')) {
                $path = FileService::upload(
                    file: $request->file('avatar'),
                    path: MediaPath::Avatar,
                    fileName: 'avatar',
                    suffix: $request->user()->id,
                    disk: 'public',
                    imageWidth: 150,
                    imageHeight: 150,
                );
                $request->user()->avatar()->updateOrCreate([
                    'path' => $path,
                ]);
            }

            return response()->json([
                'message' => __('Profile updated successfully.'),
            ]);
        }

        return response()->json([
            'message' => __('Failed to update profile! Please try again.'),
        ], 400);
    }
}
