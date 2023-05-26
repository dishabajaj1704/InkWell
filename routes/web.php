<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/blogs/trashed', [BlogsController::class, 'trashed'])->name('blogs.trashed');
        Route::delete('/blogs/{blog}/trash', [BlogsController::class, 'trash'])->name('blogs.trash');
        Route::put('/blogs/{blog}/restore', [BlogsController::class, 'restore'])->name('blogs.restore');

        Route::resource('categories', CategoriesController::class)->except('show');
        Route::resource('tags', TagsController::class)->except('show');
        Route::resource('blogs', BlogsController::class);

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    });




});

require __DIR__ . '/auth.php';
