<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('posts.index');
    }
}
