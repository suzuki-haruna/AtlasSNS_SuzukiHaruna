<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['post','user_id'];
    //public $fillable = ['user_id', 'post']; //書き込み可能[post] 必須項目 $guarded or $fillable
    //★

    //リレーション
    public function user(){
        return $this->belongsTo('App\User');
        }

    // 【投稿】
    // 一覧画面
    /*public function index(Int $user_id, Array $follow_ids)
    {
        // 自身とフォローしているユーザIDを結合する
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }*/
}
