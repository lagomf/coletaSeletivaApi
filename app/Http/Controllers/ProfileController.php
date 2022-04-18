<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request){
        return response()->json(Auth::user());
    }

    public function update(UpdateProfileRequest $request){
        $user = Auth::user();

        $user->update($request->validated());

        return response()->json($user);
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $user = Auth::user();

        $user->update($request->validated());

        return response()->json($user);
    }
}
