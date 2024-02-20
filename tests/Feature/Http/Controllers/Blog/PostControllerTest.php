<?php

namespace Tests\Feature\Http\Controllers\Blog;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * Трейт обновляет структуру сущности (таблицы БД)
     * при запуске теста подобно php artisan migrate:refresh
     */
    //use RefreshDatabase;

    /**
     * При добавлении этого свойства обновляет seeds
     */
    //protected bool $seed = true;

    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/blog/posts', );

        $response->assertStatus(200);
    }
}
