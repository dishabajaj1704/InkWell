<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FrontendController;
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

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/categories/{category}/blogs', [FrontendController::class, 'category'])->name('frontend.category');
Route::get('/tags/{tag}/blogs', [FrontendController::class, 'tag'])->name('frontend.tag');
Route::get('/blogs/{blog}', [FrontendController::class, 'show'])->name('frontend.blogs.show');
Route::delete('/comments/{comment}/delete', [FrontendController::class, 'destroy'])->name('frontend.comments.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::resource('frontend/comments', CommentsController::class)->name('frontend');
Route::resource('/frontend/comments', CommentsController::class);
Route::get('/admin/comments', [CommentsController::class, 'index'])->name('admin.comments');
Route::post('/admin/comments/{comment}/verifyComment', [CommentsController::class, 'verifyComment'])->name('admin.comments.verify');

Route::middleware('auth')->group(function () {


    Route::prefix('/admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');



        Route::get('/blogs/trashed', [BlogsController::class, 'trashed'])->name('blogs.trashed');
        Route::delete('/blogs/{blog}/trash', [BlogsController::class, 'trash'])->name('blogs.trash');
        Route::get('/blogs/drafted', [BlogsController::class, 'drafted'])->name('blogs.drafted');
        Route::post('/blogs/{blog}/draft', [BlogsController::class, 'draft'])->name('blogs.draft');
        Route::put('/blogs/{blog}/undraft', [BlogsController::class, 'undraft'])->name('blogs.undraft');
        Route::put('/blogs/{blog}/restore', [BlogsController::class, 'restore'])->name('blogs.restore');
        Route::post('/blogs/{blog}/verifyBlog', [BlogsController::class, 'verifyBlog'])->name('blogs.verifyBlog');


        Route::resource('categories', CategoriesController::class)->except('show');
        Route::resource('tags', TagsController::class)->except('show');
        Route::resource('blogs', BlogsController::class);
        Route::resource('users', RegisteredUserController::class);
        Route::post('/users/{id}/makeRevokeAdmin', [RegisteredUserController::class, 'makeRevokeAdmin'])->name('users.makeRevokeAdmin');
        Route::post('/users/{id}/verifyEmail', [RegisteredUserController::class, 'verifyEmail'])->name('users.verifyEmail');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




    });




});

require __DIR__ . '/auth.php';
