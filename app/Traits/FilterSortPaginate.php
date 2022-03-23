<?php

namespace App\Traits;

use eloquentFilter\QueryFilter\ModelFilters\Filterable;

trait FormatDates
{
    use Filterable;

    public static function filterSortPaginate($perpage){
        return self::ignoreRequest(['perpage'])
            ->filter()
            ->paginate($perpage, ['*'], 'page', request()->page ?? 1)
            ->appends(request()->query());
    }
}