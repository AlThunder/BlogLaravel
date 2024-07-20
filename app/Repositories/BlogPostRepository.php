<?php

namespace App\Repositories;

use App\Http\Requests\BlogPostFilterRequest;
use App\Models\BlogPost as Model;
use App\Http\Filters\BlogPostFilter;
use App\Models\Traits\Filterable;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    use Filterable;
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить список статей для вывода в списке
     * (Админка)
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate(BlogPostFilterRequest $request)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];
        $filter = app()->make(BlogPostFilter::class, ['queryParams'=> array_filter($request->validated())]);

        $result = $this
            ->startConditions()
            ->filter($filter) // добавление фильтра (пока только через строку запроса)
            ->select($columns)
            ->orderBy('id', 'DESC')
            //->with(['category', 'user'])
            ->with([
                // можно так
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                // или так
                'user:id,name'
            ])
            ->paginate(25);
        return $result;
    }

    /**
     * Получить модель для редактирования в админке.
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
