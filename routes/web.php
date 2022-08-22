<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [ HomeController::class , 'index' ]);
Route::get('admin', function () {
    return view('admin.category.category', []);
});
Route::get('admin/post', function () {
    return view('admin.post.from_post', []);
});
Route::get('login', function () {
    return view('auth.login', []);
})->name('login');