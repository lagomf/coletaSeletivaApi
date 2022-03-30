<?php

namespace App\Models;

use App\Traits\FilterableResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\FilterSortPaginate;
use App\Traits\IncludesRelationships;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, SoftDeletes, FilterableResource;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be filterable.
     *
     * @var array
     */
    private static $whiteListFilter =[
        'id',
        'username',
        'email'
    ];

    /**
     * The relationships that should be includable.
     *
     * @var array
     */
    private static $whiteListInclude =[
        'roles',
        'supportRequests',
        'supportRequestsResponded'
    ];

    /**
     * Mutator for hashing the password on save
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function supportRequests(){
        return $this->hasMany(SupportRequest::class,'requester_id');
    }

    public function supportRequestsResponded(){
        return $this->hasMany(SupportRequest::class,'responder_id');
    }
}
