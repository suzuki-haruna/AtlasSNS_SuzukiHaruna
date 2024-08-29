<?php

//フォロー機能ではここは多分記入しなくてよい//★2

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow; //追加
use App\User; //userモデルを使う
use App\Post;
use Illuminate\Support\Facades\Auth; // Auth(認証)ファサードを読み込む
use Illuminate\Support\Facades\DB; //DB接続に必要なクラスをインポートする

class FollowsController extends Controller
{
    public function followList(Post $posts, User $user){

        //フォロー
        //$users = User::all();
        //$following_id = Auth::user()->follows->pluck('followed_id'); //フォローしているユーザーのidを獲得

        //フォロー投稿
        $user = Auth::user();
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        //ddd($follower);

        $posts = User::select('users.username','posts.id','posts.post','posts.created_at','users.images','posts.user_id')//'posts.*','posts.user_id',
        ->whereIn('user_id', Auth::user()->followPost())
        ->orWhere('user_id', $user->id)
        ->join('posts','posts.user_id','=','users.id')
        ->orderBy('created_at','desc')
        ->get();

        //アイコン
        $follow_list = User::select('users.id', 'users.images', 'follows.followed_id', 'follows.following_id')
        ->whereIn('following_id', Auth::user())
        //->orWhere('following_id', Auth::user()->followPost())
        //->orWhere('followed_id', $user->id)
        ->join('follows','follows.followed_id','=','users.id')
        ->get();
        //ddd($follow_list);

        return view('follows.followList', compact('posts', 'follow_list'));//'followed_id'
    }

    public function followerList(Post $posts, User $user){

        //フォワー投稿
        $user = Auth::user();
        $followed = auth()->user();
        $is_followed = $followed->isFollowed($user->id); //$is_followedにしたい

        $posts = User::select('users.username','posts.id','posts.post','posts.created_at','users.images','posts.user_id')//'posts.*','posts.user_id',
        ->whereIn('user_id', Auth::user()->followedPost())
        ->orWhere('user_id', $user->id)
        ->join('posts','posts.user_id','=','users.id')
        ->orderBy('created_at','desc')
        ->get();

        //アイコン
        $follow_list = User::select('users.id', 'users.images', 'follows.followed_id', 'follows.following_id')
        ->whereIn('followed_id', Auth::user())
        //->orWhere('following_id', Auth::user()->followPost())
        //->orWhere('followed_id', $user->id)
        ->join('follows','follows.following_id','=','users.id')
        ->get();
        //ddd($follow_list);
        /*$follow_list = User::select('users.id', 'users.images', 'follows.followed_id', 'follows.following_id')
        ->whereIn('following_id', Auth::user()->followPost())
        ->orWhere('followed_id', $user->id)
        ->join('follows','follows.followed_id','=','users.id')
        ->get();*/

        return view('follows.followerList', compact('posts', 'follow_list'));
        //return view('follows.followerList');
    }

    //追加 フォロー
    public function follow(User $user){
        $follower = auth()->user();//Auth::User();
        $is_following = $follower->isFollowing($user->id); //フォローしているか
        if(!$is_following){
            $follower->follow($user->id); //フォローしていなければフォローする
        return back(); //直前のページにリダイレクト
        }
    }

    //フォロー解除
    public function unfollow(User $user){
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id); //フォローしているか
        if($is_following){
            $follower->unfollow($user->id); //フォローしていれば解除する
            return back(); //直前のページにリダイレクト
        }
    }

    //フォローフォロワー数
    //〇$fw = new Follow(); // Followモデルのインスタンス化
    //〇$follows = $fw->getData();
    //$follows = DB::table('follows')->get();
    //〇return view('posts.index', ['follows' => $follows]);
    //}
    //posts.index follow.index
    /*public function show(User $user){
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

    return view('users.show', [
        'follow_count'   => $follow_count,
        'follower_count' => $follower_count
        ]);
    }*/

    //テスト
    public function followsCreate(Request $request)
    {
        $name = $request->input('followId');
        Follows::create(['following_id' => $following_id]);
        return back();
    }
}
