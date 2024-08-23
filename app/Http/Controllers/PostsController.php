<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //現在ログインしているユーザー獲得
use App\User;
use App\Post; //postsテーブルのデータ獲得
use App\Follow;

class PostsController extends Controller
{
    // 【投稿】
    /*public function index(){
    $posts = Post::get();   // Postモデル経由でpostsテーブルのレコードを取得
    return view('posts.index', compact('posts'));
    }*/

    // Auth認証
    public function __construct(){
    $this->middleware('auth');
    }

    public function index(Post $posts, User $user){//Post $posts, Follow $follows

        /*$posts = Post::query()->whereIn('user_id', Auth::user()->followd()->pluck('followed_id'))->latest()->get();
        return view('posts.index')->with([
            'posts' => $posts,
            ]);*/

      /*$user = Auth::user();
      $posts = Post::get();
      $following_id = auth()->user()->follows()->pluck('followed_id');
      $posts = Post::orderBy('created_at','desc')->with('user')->whereIn('user_id',$following_id)->orWhere('user_id',$user->id)->get();
      return view('posts.index',['user'=>$user, 'posts'=>$posts]);*/

$user = Auth::user();
$follower = auth()->user();//Auth::User();
//$posts = User::select('users.username','posts.id','posts.post','posts.created_at');
$is_following = $follower->isFollowing($user->id);

$posts = User::select('users.username','posts.id','posts.post','posts.created_at','users.images','posts.user_id')//'posts.*','posts.user_id',
->whereIn('user_id', Auth::user()->followPost())
->orWhere('user_id', $user->id)
->join('posts','posts.user_id','=','users.id')
->orderBy('created_at','desc')
->get();

/*$user = auth()->user();
        $follow_ids = $follows->followingIds($user->id);
        // followed_idだけ抜き出す
        $following_ids = $follow_ids->pluck('followed_id')->toArray();

        $posts = $tweet->getTimelines($user->id, $following_ids);

        return view('posts.index', [
            'user' => $user,
            'post' => $posts
        ]);*/
        //$posts = Post::all(); //データベース内のすべてのPostを取得し、post変数に代入
        //$posts = Post::get(); //Postモデル(postsテーブル)からレコード情報を取得
//〇$list=Post::get(); //Postモデル(postsテーブル)からレコード情報を取得
//〇return view('posts.index', ['list'=>$list]); //bladeへ帰す際にデータを送る
        //return view('posts/index', ['posts'=>$posts]);
        // 'posts'フォルダ内の'index'viewファイルを返す
        // その際にview内で使用する変数を代入します

        // フォローしているユーザーのみの情報を取得
        //$following_id = Auth::user()->follows()->pluck('followed_id'); // フォローしているユーザーのidを取得
        /*$posts = Post::with('user')->whereIn('users_id', $following_id)->orWhere('user_id', 'id') ->get();*/ // フォローしているユーザーのidを元に投稿内容を取得

        //参考FollowsController
        /*$user = Auth::user();
        $follower = auth()->user();//Auth::User();
        $is_following = $follower->isFollowing($user->id); //フォローしているか
        if($is_following){
            $follower->follow($user->id);*/

    //public function show(){
    //$posts = Post::get(); // Postモデル経由でpostsテーブルのレコードを取得
    return view('posts.index', compact('posts')); //★

    /*$posts = \DB::table('posts') // postsテーブルからすべてのレコード情報をゲットする
    ->join('users', 'posts.id', '=', 'users.id')
    ->get();
    return view('posts.index',['posts'=>$posts]); // postsディレクトリにあるindex.blade.phpに渡す*/

    //}
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
    }*/

    //投稿編集
    //dd
    /*public function update(Request $request, $id){
      $posts = Post::find($id);
      $posts->post = $request->post;
      $posts->save();
      return redirect('posts.index');
    }*/
    public function update(Request $request, Post $post){
      $id = $request->input('id');
      $up_post = $request->input('upPost');

      $post = \DB::table('posts')
      ->where('id', $request->id)
      ->update(['post' => $up_post]);
      return redirect('/index')->with('warning', '編集完了');
    }

    //投稿削除
    public function delete($id){
      /*$posts = Post::find($id);
      $posts->delete();*/


      \DB::table('posts')
      ->where('posts.id', $id)
      ->delete();

      $user_id = Auth::user()->id;

      return redirect('/index');
      //return back();
    }

}
