<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('section/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewCategoryPost']);
Route::get('/section/{category_slug}/{post_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewPost']);

Route::post('add-comment', [App\Http\Controllers\Frontend\CommentController::class, 'store']);
Route::post('delete-comment', [App\Http\Controllers\Frontend\CommentController::class, 'destroy']);
Route::post('reply-comment', [App\Http\Controllers\Frontend\CommentController::class, 'replyStore']);
Route::post('update-comment', [App\Http\Controllers\Frontend\CommentController::class, 'update']);
Route::post('add-like', [App\Http\Controllers\Frontend\CommentController::class, 'likeStore']);
Route::post('delete-like', [App\Http\Controllers\Frontend\CommentController::class, 'likeDestroy']);

Route::get('/mark-as-read', [App\Http\Controllers\Frontend\NotificationController::class,'markAsRead'])->name('mark-as-read');
Route::get('/clear-all', [App\Http\Controllers\Frontend\NotificationController::class,'clearAll'])->name('clear-all');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::post('delete-category', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    Route::get('posts', [App\Http\Controllers\Admin\BlogPostController::class, 'index']);
    Route::get('add-post', [App\Http\Controllers\Admin\BlogPostController::class, 'create']);
    Route::post('add-post', [App\Http\Controllers\Admin\BlogPostController::class, 'store']);
    Route::get('edit-post/{post_id}', [App\Http\Controllers\Admin\BlogPostController::class, 'edit']);
    Route::put('update-post/{post_id}', [App\Http\Controllers\Admin\BlogPostController::class, 'update']);
    Route::post('delete-post', [App\Http\Controllers\Admin\BlogPostController::class, 'destroy']);

    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('update-user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'update']);


});

Route::prefix('author')->middleware(['auth', 'isAuthor'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Author\DashboardController::class, 'index']);

    Route::get('category', [App\Http\Controllers\Author\CategoryController::class, 'index']);

    Route::get('posts', [App\Http\Controllers\Author\BlogPostController::class, 'index']);
    Route::get('add-post', [App\Http\Controllers\Author\BlogPostController::class, 'create']);
    Route::post('add-post', [App\Http\Controllers\Author\BlogPostController::class, 'store']);
    Route::get('edit-post/{post_id}', [App\Http\Controllers\Author\BlogPostController::class, 'edit']);
    Route::put('update-post/{post_id}', [App\Http\Controllers\Author\BlogPostController::class, 'update']);
    Route::post('delete-post', [App\Http\Controllers\Author\BlogPostController::class, 'destroy']);
});
