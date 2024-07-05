<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow; //追加

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

    //フォローフォロワー数
    public function follow(){
   	//viewの呼び出し
   	//return view('login');
    $fw = new Follow(); // Followモデルのインスタンス化
    $follows = $fw->getData();
    //$follows = DB::table('follows')->get();
return view('posts.index', ['follows' => $follows]);
   }
   //posts.index follow.index
}
