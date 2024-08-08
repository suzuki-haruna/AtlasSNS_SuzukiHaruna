<?php

//フォロー機能：ここは多分触らなくていい

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //追加 フォローフォロワー？


class Follow extends Model
{
    /*public function index(){
        return view('follows.followsList');
    }*/

    // フォローしているユーザのIDを取得
    /*public function index(Int $user_id)
    {
        return $this->where('following_id', $user_id)->get('followed_id');
    }*/

//★
    //フォローフォロワー数表示
    /*public function getData(){
       $follows = DB::table($this->table)->get();
       return $follows;
    }*/
    /*protected $fillable = [
    'following_id', 'followed_id'
    ];

    public function getFollowCount($user_id)
    {
        return $this->where('following_id', $user_id)->count();
    }

    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }*/

}
