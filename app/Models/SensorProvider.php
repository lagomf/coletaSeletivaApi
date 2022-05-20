<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','identifier'
    ];
}
