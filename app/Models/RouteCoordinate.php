<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteCoordinate extends Model
{
    use HasFactory;

    protected $fillable = [
        'lat','long','route_id'
    ];

    public $timestamps = false;
}
