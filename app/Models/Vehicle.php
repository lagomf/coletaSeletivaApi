<?php

namespace App\Models;

use App\Traits\FilterableResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes, FilterableResource;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'plate',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * The attributes that should be filterable.
     *
     * @var array
     */
    private static $whiteListFilter =[
        'id',
        'name',
        'plate',
        'status'
    ];

    /**
     * The relationships that should be includable.
     *
     * @var array
     */
    private static $whiteListInclude =[
        
    ];
}
