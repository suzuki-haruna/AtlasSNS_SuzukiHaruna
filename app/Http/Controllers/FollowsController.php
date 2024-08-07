<?php

//フォロー機能：ここは多分完了。30行目のreturnは怪しい(index表示)

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow; //追加
use App\User; //userモデルを使う
use App\Post;
use Illuminate\Support\Facades\Auth; // Auth(認証)ファサードを読み込む
use Illuminate\Support\Facades\DB; //DB接続に必要なクラスをインポートする

class FollowsController extends Controller
{
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

    //追加 フォロー
    public function follow(User $user){
        $follower = Auth::User();
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

    //テスト
    public function followsCreate(Request $request)
    {
        $name = $request->input('followId');
        Follows::create(['following_id' => $following_id]);
        return back();
    }
}
//★
