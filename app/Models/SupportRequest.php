<?php

namespace App\Models;

use App\Traits\FilterableResource;
use App\Traits\FilterSortPaginate;
use App\Traits\IncludesRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportRequest extends Model
{
    use HasFactory, FilterableResource, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'reason', 'status','requester_id','responder_id','response',
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
        'type',
        'reason',
        'status',
        'requester_id',
        'responder_id',
        'resolved_at'
    ];

    /**
     * The relationships that should be includable.
     *
     * @var array
     */
    private static $whiteListInclude =[
        'requester',
        'responder'
    ];

    public function requester(){
        return $this->belongsTo(User::class,'requester_id');
    }

    public function responder(){
        return $this->belongsTo(User::class,'responder_id');
    }
}
