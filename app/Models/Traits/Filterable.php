<?php


namespace App\Models\Traits;


use App\Http\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param FilterInterface $filter
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, FilterInterface $filter) // в Laravel scope пропускается и вызывается
    {                                                                      // метод, например как здесь Model::filter($params)
        $filter->apply($builder);

        return $builder;
    }
}
