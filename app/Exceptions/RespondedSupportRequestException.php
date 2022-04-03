<?php

namespace App\Exceptions;

use Exception;

class RespondedSupportRequestException extends Exception
{
    public function render(){
        return response()->json([
            'message' => 'Trying to respond a support request that was already responded.'
        ],400);
    }
}
