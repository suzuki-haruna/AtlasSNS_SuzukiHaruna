<?php

use App\Http\Controllers\PostsController; //PostsControllerを読み込み

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
//Here is where you can register(ここは登録することができる)web

// Route::①('②','③');
/*
①HTTP上の通信方法(POST,GET)
②どのURLで表示するか
③どのメソッド(または関数)とつなげるか
*/

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login'); //必要(name属性追加)//★
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
Route::post('/index','PostsController@postCreate');//POST通信でPostsControllerのpostCreateメソッドとつなげる
//Route::get('/index','PostsController@show');
//Route::post('/index','PostsController@index'); //POST通信でPostsControllerのindexメソッドとつなげる
//Route::post('/create','PostsController@postCreate');
//Route::get('/index', [PostController::class, 'index'])->name('index'); //posts.index
//Route::resource('/index', PostsController::class);//CRUD機能に必要なアクションをすべて作ったので、ルートもresourceを使用

//Route::get('/follow','FollowsController@follow'); //追加(/indexではないものにする→一先ず/follow)

//Route::get('/profile','UsersController@profile')

Route::get('/profile','UsersController@profile')->name('profile');
Route::put('/profile', 'UserController@profileUpdate')->name('profile_edit');
Route::post('profile/{id}/update','UsersController@update');

//Route::post('/profile', 'UserController@profile');
//追加 プロフィール編集
//Route::put('/password_change', 'UserController@passwordUpdate')->name('password_edit'); //追加 パスワード編集

Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');
/*Route::get('/follow-list', function(){
  return view('follow-list');
});*/

//フォロー
Route::post('users/{user}/follow','FollowsController@follow')->name('follow'); //{id}
Route::delete('users/{user}/unfollow','FollowsController@unfollow')->name('unfollow');
//動画
//Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'show'])->name('user.show');

//Route::get('/login', 'Auth\LoginController@login')->name('login'); //追加04

//Route::get('users/show','FollowsController@follow'); //追加(/indexではないものにする→一先ず/follow)

//追加04 ログアウト
Route::get('/logout', 'Auth\LoginController@logout');

}); //追加04
