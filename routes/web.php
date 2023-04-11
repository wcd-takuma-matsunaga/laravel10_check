<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
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

Route::get('/test', [TestController::class, 'test'])->name('test');

//postの一覧表示のルート設定
Route::middleware(['auth'])->group(function () {
    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/create', [PostController::class, 'create']);
//    showメソッドのルート
    Route::get('/post/show/{post}', [PostController::class, 'show'])->name('post.show');
//    個別投稿記事の編集画面
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
//    個別投稿記事の更新
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
//    個別投稿記事の削除
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
