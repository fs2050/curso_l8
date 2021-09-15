<?php

use App\Http\Controllers\{
    PostController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');
route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
route::post('/posts', [PostController::class, 'store'])->name('posts.store');

route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/', function () {
    return view('welcome');
});
