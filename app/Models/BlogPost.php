<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 *
 * @package App\Models
 *
 * @property \App\Models\BlogCategory $category
 * @property \App\Models\User $user
 * @property string $title
 * @property string $slug
 * @property string $content_html
 * @property string $content_row
 * @property string $excerpt
 * @property string $published_at
 * @property boolean $is_published
 */
class BlogPost extends Model
{
    use SoftDeletes, HasFactory, Filterable;

    const UNKNOWN_USER = 1; //TODO: unknown_user убрать костыль при аутентификации

    protected $fillable
        = [
            'title',
            'slug',
            'category_id',
            'excerpt',
            'content_raw',
            'is_published',
            'published_at',
        ];

    /**
     * Категория статьи.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        // Статья принадлежит категории
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Автор статьи.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Статья принадлежит пользователю
        return $this->belongsTo(User::class);
    }
}
