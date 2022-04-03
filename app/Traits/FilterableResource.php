<?php

namespace App\Traits;

use App\Exceptions\IncludeRelationshipsRequestException;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Support\Facades\Gate;

trait FilterableResource
{
    use Filterable;

    public static function scopeFilterSortPaginate($query){
        return $query->ignoreRequest([' ','include','withTrashed'])
            ->filter()
            ->paginate(request()->perpage, ['*'], 'page', request()->page ?? 1)
            ->appends(request()->query());
    }

    private static function handleIncludeParam(){
        $includeList = [];
        if(request()->has('include')){
            $includeList = explode(',',request()->include);
            if(array_diff($includeList,self::$whiteListInclude)){
                throw new IncludeRelationshipsRequestException();
            }
        }
        return $includeList;
    }

    public static function scopeWithRelationships($query){
        $includeList = self::handleIncludeParam();

        return $query->ignoreRequest(['include'])->with($includeList);
    }

    public function scopeWithTrashedResource($query){
        if(request()->has('withTrashed')){
            Gate::authorize('withTrashed',self::class);

            return $query->withTrashed();
        }
        return $query;
    }
}