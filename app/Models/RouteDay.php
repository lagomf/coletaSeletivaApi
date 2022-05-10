<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id','day'
    ];

    public $timestamps = false;    
}
