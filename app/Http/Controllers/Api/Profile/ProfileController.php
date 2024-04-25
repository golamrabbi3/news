<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\ProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $data = request()->user()->only(['name', 'email', 'created_at']);
        $data['avatar'] = request()->user()->avatar?->path;

        return response()->json([
            'message' => __('Fetched profile information successfully.'),
            'data' => $data,
        ]);
    }

    public function update(ProfileRequest $request)
    {
        if ($request->user()->update($request->validated())) {
            // TODO::Make Service Provider to upload image
            $avatar = "https://i.pravatar.cc/150?img={$request->user()->id}";
            $request->user()->avatar()->updateOrCreate([
                'path' => $avatar,
            ]);

            return response()->json([
                'message' => __('Profile updated successfully.'),
            ]);
        }

        return response()->json([
            'message' => __('Failed to update profile! Please try again.'),
        ], 400);
    }
}
