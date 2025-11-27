<?php

namespace App\Http\Controllers;

use App\Jobs\SendResetOTPJob;
use App\Models\PasswordResetTokens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
   
    protected $otpDurationMinutes = 10;

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        $otpCode = Str::padLeft(random_int(100000, 999999), 6, '0');
        $expiresAt = now()->addMinutes($this->otpDurationMinutes);

        PasswordResetTokens::where('user_id', $user->id)->delete();

        PasswordResetTokens::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'token' => $otpCode, 
            'expires_at' => $expiresAt,
        ]);
        
        
        SendResetOTPJob::dispatch($user->email, $otpCode);
        
        return response()->json([
            'message' => 'Password reset token has been sent to your email.'
        ]);
    }

    public function resetPassword(Request $request) 
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|digits:6', // Ensure it's 6 digits
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        
        $otpRecord = PasswordResetTokens::where('user_id', $user->id)
            ->where('token', $request->token)
            ->latest() 
            ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'OTP verification failed: Invalid Code.'], 401);
        }
        
        if ($otpRecord->expires_at->isPast()) {
            $otpRecord->delete(); 
            return response()->json(['message' => 'OTP verification failed: Code has expired.'], 401);
        }
        
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();
        
        $otpRecord->delete(); 
        return response()->json([
            'message' => 'Password has been successfully reset. You can now log in.'
        ]);
    }
}