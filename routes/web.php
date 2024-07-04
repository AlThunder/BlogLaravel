<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Очистка кеша
/*\Artisan::call('cache:clear');
\Artisan::call('config:cache');
\Artisan::call('view:clear');
\Artisan::call('route:clear');
//\Artisan::call('backup:clean'); // не работает - нет такой команды
//php artisan cache:clear
//php artisan event:clear
//php artisan config:clear
//php artisan view:clear
//php artisan route:clear
//php artisan backup:clear*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collections', 'App\Http\Controllers\DiggingDeeperController@collections')
        ->name('digging_deeper.collections');

    Route::get('process-video', 'App\Http\Controllers\DiggingDeeperController@processVideo')
        ->name('digging_deeper.processVideo');

    Route::get('prepare-catalog', 'App\Http\Controllers\DiggingDeeperController@prepareCatalog')
        ->name('digging_deeper.prepareCatalog');
});

Route::group(['namespace' => 'App\Http\Controllers\Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', 'PostController')->names('blog.posts');
});

//> Админка Блога
$groupData = [
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog'
];
Route::group($groupData, function () {
    // BlogCategory
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');
    // BlogPosts
    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
});
//<

//Route::resource('rest', 'App\Http\Controllers\RestTestController')->names('restTest');
