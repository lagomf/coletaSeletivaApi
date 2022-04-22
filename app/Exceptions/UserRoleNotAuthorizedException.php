<?php

namespace App\Exceptions;

use Exception;

class UserRoleNotAuthorizedException extends Exception
{
    public function render(){
        return response()->json([
            'message' => 'You are not authorized to assign this role'
        ],403);
    }
}
