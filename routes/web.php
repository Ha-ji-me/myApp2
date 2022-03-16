<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', function() {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});


// 出来事投稿crud
Route::resource('/incident-post', 'IncidentPostController');
// コメント機能
Route::post('/incident-post/comment/store', 'CommentController@store')->name('comment.store');
// 自分の投稿ページ
Route::get('/mypost', 'HomeController@mypost')->name('home.mypost');
// コメントした投稿ページ
Route::get('/mycomment', 'HomeController@mycomment')->name('home.mycomment');
// お気に入り投稿ページ
// 管理者ページ
