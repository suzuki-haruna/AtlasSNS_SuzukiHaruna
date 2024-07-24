<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //追加 フォローフォロワー？


class Follow extends Model
{
        public function index(){
        return view('follows.followsList');
    }

    //
    //フォローフォロワー数表示
        protected $table = 'follows'; //テーブル名のセット

    public function getData(){
       $follows = DB::table($this->table)->get();
       return $follows;
    }
}
