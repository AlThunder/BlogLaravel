<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class BlogPostFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const CONTENT_RAW = 'content_raw';
    public const CATEGORY_ID = 'category_id';


    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::CONTENT_RAW => [$this, 'content_raw'],
            self::CATEGORY_ID => [$this, 'categoryId'],
        ];
    }

    public function title(Builder $builder, $value)
    {

        $builder->where('title', 'like', "%{$value}%");
    }

    public function contentRaw(Builder $builder, $value)
    {
        $builder->where('content_raw', 'like', "%{$value}%");
    }

    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }
}
