<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\EmailVerificationRequest;
use App\Mail\Api\Profile\EmailVerificationMail;
use App\Mail\Api\Profile\EmailVerifiedMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function index(): JsonResponse
    {
        if (request()->user()->email_verified_at) {
            return response()->json([
                'message' => __('The email address is already verified.'),
            ], 409);
        }

        $OTP = random_int(100000, 999999);
        cache()->put("verification_" . request()->user()->email, $OTP, 1800);
        Mail::to(request()->user()->email)
            ->send(new EmailVerificationMail(request()->user()->name, $OTP));

        return response()->json([
            'message' => __('An email verification code has been sent to your email address.'),
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
            cache()->forget("verification_" . $request->user()->email);
            Mail::to($request->user()->email)->send(new EmailVerifiedMail($request->user()->name));

            return response()->json([
                'message' => __('The email address has been verified successfully.'),
            ]);
        }

        return response()->json([
            'message' => __('Failed to verify the email address! Please try again.'),
        ], 403);
    }
}
