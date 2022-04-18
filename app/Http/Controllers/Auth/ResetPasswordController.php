<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request){
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if($status === Password::RESET_LINK_SENT){
            return response()->json([
                'message' => __($status)
            ]);
        }
        return response()->json([
            'message' => __($status)
        ],400);
    }

    public function resetPassword(ChangePasswordRequest $request){
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        if($status === Password::PASSWORD_RESET){
            return response()->json([
                'message' => __($status)
            ]);
        }
        return response()->json([
            'message' => __($status)
        ],400);
    }
}
