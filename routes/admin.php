<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return "Hello Admin";
// });
// Route::get('/', function () {
//     return "Hello Admin";
// })->name('dashboard');

// Route::get('/cursos', function () {
//     return "Admin Users";
// })->name('cursos');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostsController::class);
});