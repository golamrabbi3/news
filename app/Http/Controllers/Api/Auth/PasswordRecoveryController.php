<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RecoverRequest;
use App\Http\Requests\Api\Auth\ValidEmailRequest;
use App\Mail\Api\Auth\PasswordRecoveredMail;
use App\Mail\Api\Auth\PasswordRecoveryMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordRecoveryController extends Controller
{
    public function index(ValidEmailRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $OTP = random_int(100000, 999999);

        Mail::to($user->email)->send(new PasswordRecoveryMail($user->name, $OTP));

        return response()->json([
            'message' => __('A password recovery OTP has been sent to your email address.'),
            'data' => [
                'hash_code' => Hash::make($OTP),
                'email' => $user->email,
            ],
        ]);
    }

    public function recover(RecoverRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if ($user->update(['password' => $request->password])) {
            $user->tokens()->delete();
            Mail::to($user->email)->send(new PasswordRecoveredMail($user->name));

            return response()->json([
                'message' => __('The password has been recovered successfully.'),
            ]);
        }

        return response()->json([
            'message' => __('Failed to recover the password! Please try again.'),
        ], 400);
    }
}
