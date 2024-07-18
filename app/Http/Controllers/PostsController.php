<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //現在ログインしているユーザー獲得
use App\user;
use App\post; //postsテーブルのデータ獲得

class PostsController extends Controller
{
    //
    //中間テーブル
    /* $user = User::find(1);
        foreach ($user->users as $user) {
        dd($user->pivot->quantity);
    } */
    /*public function postCounts(){
    $posts = Post::get();
    return view('login', compact('posts'));
    }*/ //中間テーブル

    public function index(){
        //$posts = Post::all(); //データベース内のすべてのPostを取得し、post変数に代入
        //$posts = Post::get(); //Postモデル(postsテーブル)からレコード情報を取得
        $list=Post::get(); //Postモデル(postsテーブル)からレコード情報を取得
        return view('posts.index', ['list'=>$list]); //bladeへ帰す際にデータを送る
        //return view('posts/index', ['posts'=>$posts]);
        // 'posts'フォルダ内の'index'viewファイルを返す
        // その際にview内で使用する変数を代入します
    }

    public function postCreate(Request $request){

        // バリデーション
        $request->validate([
              'newPost' => 'required|max:150',
        ]);

        $post = $request->input('newPost'); //投稿フォームに書かれた投稿を受け取る
        $user_id = Auth::user()->id;
        Post::create([ // 投稿の登録
            'user_id' => $user_id,
            'post' => $post,
            // postテーブルの'user_id','post'に変数を当てはめる
        ]);
        return redirect('/index'); //URL変えたほうがいいかも
    }

/*    public function create(){ //Createは新規投稿作成画面を表示するアクション
        return view('posts/index'); //URL変えたほうがいいかも
    }

    public function store(Request $request){ //データを作成し、データベースに保存するアクション
      $posts = new Post; // 新しい Post を作成
      $posts->post = $request->post; // フォームから送られてきたデータを代入
      $posts->save(); // データベースに保存
      return redirect('posts/index'); // indexページへ遷移
    }

    public function show($id){ //詳細画面のように、データを一つずつ表示するページ
      $posts = Post::find($id); // idでPostを探し出す
      return view('posts.index', ['post' => $posts]);
    }

    public function edit($id){ //編集
      $posts = Post::find($id);
      return view('posts.index', ['post' => $posts]);
    }

    public function update(Request $request, $id){
      $posts = Post::find($id);
      $posts->post = $request->post;
      $posts->save();
      return redirect('posts.index');
    }

    public function destroy($id){ //削除機能
      $posts = Post::find($id);
      $posts->delete();
      return redirect('posts.index');
    } */
}

//★
