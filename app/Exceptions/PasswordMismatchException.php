<?php

namespace App\Exceptions;

use Exception;

class PasswordMismatchException extends Exception
{
    public function render(){
        return response()->json([
            'message' => 'Wrong password.'
        ],422);
    }
}
