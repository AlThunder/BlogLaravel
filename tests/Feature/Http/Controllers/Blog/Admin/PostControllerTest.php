<?php

namespace Tests\Feature\Http\Controllers\Blog\Admin;

use App\Jobs\BlogPostAfterCreateJob;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/admin/blog/posts');

        $response->assertStatus(200);
    }

    public function test_create(): void
    {

        $response = $this->get('/admin/blog/posts/create');

        $response->assertStatus(200);
    }

    public function test_store(): void
    {
        Bus::fake();
        $data = BlogPost::factory()->create();

        BlogPostAfterCreateJob::dispatch($data);

        $this->assertModelExists($data);
        Bus::assertDispatched(BlogPostAfterCreateJob::class);
        Bus::assertNotDispatchedAfterResponse(BlogPostAfterCreateJob::class);
    }

    public function test_edit(): void
    {
        $post = BlogPost::orderby('id', 'desc')->first();

        $response = $this->get('/admin/blog/posts/'.$post->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_update(): void
    {
        $post = BlogPost::orderby('id', 'desc')->first();

        $data = BlogPost::factory()->make()->attributesToArray();
        unset(
            $data['id'],
            $data['published_at'],
            $data['created_at'],
            $data['updated_at'],
        );

        $post->update($data);
        $this->assertModelExists($post);
    }

    public function test_destroy(): void
    {
        $post = BlogPost::orderby('id', 'desc')->first();

        $post->delete();
        $this->assertSoftDeleted($post);

        $post->forceDelete();
        $this->assertModelMissing($post);

    }
}
