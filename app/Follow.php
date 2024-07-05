<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; //追加

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
