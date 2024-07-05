<?php

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
//Here is where you can register(ここは登録することができる)web★

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
//Route::group(['middleware' => 'auth'], function() { //追加04
//'verified'!?
//Route::get('/', function(){return redirect('/login');});

Route::get('/login', 'Auth\LoginController@login')->name('login'); //必要(name属性追加!?)
Route::post('/login', 'Auth\LoginController@login');//->name('login'); //必要(name属性追加!?)

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//}); //追加04

//ログイン中のページ
Route::group(['middleware' => 'auth'], function() { //追加04
//'verified'!?
//Route::get('/', function(){return redirect('/login');});

Route::get('/index','PostsController@index'); //追加04
Route::post('/index','PostsController@index');

Route::get('/index','FollowsController@follow'); //追加

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');
/*Route::get('/follow-list', function(){
  return view('follow-list');
});*/

//Route::get('/login', 'Auth\LoginController@login')->name('login'); //追加04

//追加04 ログアウト
Route::get('/logout', 'Auth\LoginController@logout');

}); //追加04
