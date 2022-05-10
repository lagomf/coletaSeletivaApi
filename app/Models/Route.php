<?php

namespace App\Models;

use App\Traits\FilterableResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use HasFactory, SoftDeletes, FilterableResource;

    protected $fillable = [
        'name','color'
    ];

    /**
     * The attributes that should be filterable.
     *
     * @var array
     */
    private static $whiteListFilter =[
        'id',
        'name',
        'districts.id',
        'districts.name',
        'days.day'
    ];

    /**
     * The relationships that should be includable.
     *
     * @var array
     */
    private static $whiteListInclude =[
        'districts',
        'coordinates',
        'days'
    ];

    public function districts()
    {
        return $this->belongsToMany(District::class,'route_district');
    }

    public function coordinates(){
        return $this->hasMany(RouteCoordinate::class);
    }

    public function days(){
        return $this->hasMany(RouteDay::class);
    }

    public function setDistricts($districts_list){
        $this->districts()->sync($districts_list);
    }

    public function setDays($days_list){
        $this->days()->delete();
        foreach($days_list as $day){
            RouteDay::create([
                'day' => $day,
                'route_id' => $this->id
            ]);
        }
    }

    public function setCoordinates(array $coordinates_list){
        $this->coordinates()->delete();
        foreach($coordinates_list as $coordinates){
            RouteCoordinate::create([
                'route_id' => $this->id,
                'lat' => $coordinates[0],
                'long' => $coordinates[1]
            ]);
        }
    }
}
