<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\EmailVerificationRequest;
use App\Mail\Api\Auth\EmailVerificationMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if ($request->user()->email_verified_at) {
            return response()->json([
                'message' => __('The email address is already verified.'),
            ], 409);
        }

        $OTP = random_int(100000, 999999);
        Mail::to($request->user()->email)
            ->send(new EmailVerificationMail($request->user()->name, $OTP));

        return response()->json([
            'message' => __('An email verification code has been sent to your email address.'),
            'data' => [
                'hash_code' => bcrypt($OTP),
            ]
        ]);
    }

    public function verify(EmailVerificationRequest $request): JsonResponse
    {
        if ($request->user()->email_verified_at) {
            return response()->json([
                'message' => __('The email address is already verified.'),
            ], 409);
        }

        if ($request->user()->update(['email_verified_at' => now()])) {
            return response()->json([
                'message' => __('The email address has been verified successfully.'),
            ]);
        }

        return response()->json([
            'message' => __('Failed to verify the email address! Please try again.'),
        ], 403);
    }
}
