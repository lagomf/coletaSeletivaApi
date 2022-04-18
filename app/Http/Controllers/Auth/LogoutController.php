<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function current(Request $request){
        $token = Auth::user()->token();
        $token->revoke();

        return response()->json([
            'message' => 'You have been successfully logged out!'
        ]);
    }

    public function all(Request $request){
        Auth::user()->revokeAllTokens();
        
        return response()->json([
            'message' => 'You have been successfully logged out everywhere!'
        ]);
    }
}
