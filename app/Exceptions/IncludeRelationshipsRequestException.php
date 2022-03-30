<?php

namespace App\Exceptions;

use Exception;

class IncludeRelationshipsRequestException extends Exception
{
    public function render(){
        return response()->json([
            'message' => 'Invalid relationship passed on include argument'
        ],400);
    }
}
