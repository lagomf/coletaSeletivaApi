<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $this->authorize('viewAny', Role::class);
        
        $roles = Auth::user()->authorizedRoles();

        return response()->json($roles);
    }
}
