<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\PasswordMismatchException;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();

        if($user){
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $roles = $user->roles->pluck('name');
                if($user->hasRole('Super Admin')){
                    $permissions = ModelsPermission::all()->pluck('name')->toArray();
                }else{
                    $permissions = [];
                    foreach($user->roles as $role){
                        $role_permissions = $role->permissions->pluck('name')->toArray();
                        $permissions = array_merge($permissions,$role_permissions);
                    }
                }
                unset($user->roles);

                $response = [
                    'token' => $token,
                    'user' => $user,
                    'roles' => $roles,
                    'permissions' => $permissions
                ];
                return response($response, 200);
            } else {
                throw new PasswordMismatchException();
            }
        }else{
            throw new UserNotFoundException();
        }
    }
}
