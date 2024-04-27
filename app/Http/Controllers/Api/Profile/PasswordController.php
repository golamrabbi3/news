<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\PasswordRequest;
use App\Mail\Api\Profile\PasswordChangedMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function __invoke(PasswordRequest $request): JsonResponse
    {
        if ($request->user()->update(['password' => $request->password])) {
            Mail::to($request->user()->email)
                ->send(new PasswordChangedMail($request->user()->name));

            return response()->json([
                'message' => __('The password has been changed successfully.'),
            ]);
        }

        return response()->json([
            'message' => __('Failed to change the password! Please try again.'),
        ], 400);
    }
}
