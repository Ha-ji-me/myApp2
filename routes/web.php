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
Route::get('/', 'HomeController@login')->middleware('guest');


// 出来事投稿crud
Route::resource('/incident-post', 'IncidentPostController');
// コメント機能
Route::post('/incident-post/comment/store', 'CommentController@store')->name('comment.store');
// 自分の投稿ページ
Route::get('/mypost', 'HomeController@mypost')->name('home.mypost');
// コメントした投稿ページ
Route::get('/mycomment', 'HomeController@mycomment')->name('home.mycomment');
// 投稿したtodoページ
Route::get('/my-todo','TodoPostController@myTodo')->name('todo-post.mypost');
// お気に入り投稿ページ
// 管理者ページ
Route::middleware(['can:admin'])->group(function() {
    Route::get('/profile/index', 'ProfileController@index')->name('profile.index');
    Route::delete('/profile/delete/{user}', 'ProfileController@delete')->name('profile.delete');
    Route::put('/roles/{user}/attach', 'RoleController@attach')->name('role.attach');
Route::put('/roles/{user}/detach', 'RoleController@detach')->name('role.detach');
});
//プロフィール編集ページ
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('/profile/{user}', 'ProfileController@update')->name('profile.update');
//todoページ
Route::get('/todo-post','TodoPostController@index')->name('todo-post.index');
Route::get('/todo-post/create','TodoPostController@create')->name('todo-post.create');
Route::post('/todo-post/store','TodoPostController@store')->name('todo-post.store');
//お気に入り
Route::get('/reply/favorite/{incidentPost}', 'FavoriteController@favorite')->name('favorite');
Route::get('/reply/unfavorite/{incidentPost}', 'FavoriteController@unfavorite')->name('unfavorite');
Route::get('/my-favorite','HomeController@myFavorite')->name('home.myFavorite');
