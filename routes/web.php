<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Entities\CommentEntity;
use App\Http\Entities\PostEntity;
use App\Http\Entities\UserEntity;
use App\Models\post;
use Illuminate\Http\Request;
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
//post
Route::get('/', [ HomeController::class , 'index' ])->name('/');
Route::any('detail_new/{id}', [ HomeController::class , 'detailNew' ])->name('detail_new');

//auth
Route::middleware('guest')->get('login', [ AuthController::class , 'login' ])->name('login');
Route::post('user_login', [ AuthController::class , 'user_login' ])->name('user_login');
Route::middleware('guest')->get('signin', [ AuthController::class , 'signin' ])->name('signin');
Route::post('add_user', [ AuthController::class , 'add_user'])->name('add_user');
Route::middleware('auth')->get('logout', [ AuthController::class , 'logout'])->name('logout');

//comments
Route::post('comment', [ CommentsController::class , 'store' ])->name('comment');
Route::delete('delete_comment/{id}', [ CommentsController::class , 'destroy' ])->name('delete_comment');


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    //bài viết
    Route::any('post', [ PostController::class ,  'index'])->name('post');
    Route::get('data_post', [ PostEntity::class, 'index' ])->name('data_post');
    Route::any('post_add', [ PostController::class , 'store'])->name('post_add');
    Route::any('edit_post/{id}', [ PostController::class, 'edit'])->name('edit_post');
    Route::any('update_post/{id}', [ PostController::class, 'update'])->name('update_post');
    Route::delete('delete_post/{id}', [ PostController::class , 'destroy'])->name('delete_post');

    //Danh mục
    Route::get('category', [ CategoryController::class , 'index'])->name('category');
    // Route::post('category', [ CategoryController::class , 'index'])->name('category');
    Route::any('add_category', [ CategoryController::class , 'store'])->name('add_category');
    Route::delete('delete_category/{id}', [ CategoryController::class , 'destroy'])->name('delete_category');
    Route::get('edit_category/{id}', [ CategoryController::class , 'edit'])->name('edit_category');
    Route::put('update_category/{id}', [ CategoryController::class , 'update'])->name('update_category');
    //role

    Route::get('user-role/{id}', [ RoleController::class, 'store' ])->name('user-role');
    Route::get('roles', [ RoleController::class, 'roles' ])->name('roles');
    Route::get('show-form-edit/{id}', [ RoleController::class, 'store' ])->name('show-form-edit-user');
    //user

    Route::get('form-edit-user/{id}', [ UserController::class , 'formEditUser'])->name('form-edit-user');
    Route::get('user', [ UserController::class , 'index'])->name('user');
    Route::get('user_data', [ UserEntity::class , 'index'])->name('user_data');
    Route::put('update_role/{id}', [ UserController::class , 'updateRole'])->name('update_role');

    //comments

    Route::any('comments', [ CommentsController::class , 'index'])->name('comments');
    Route::get('comment_data', [ CommentEntity::class , 'index'])->name('comment_data');
    Route::get('comment/{id}', [ CommentEntity::class , 'show'])->name('comment');
    Route::delete('delete_comment/{id}', [ CommentsController::class , 'destroy'])->name('delete_comment');
});
