<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//追加 プロフィール編集
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\User; //登録ユーザーのDBを使用


class UsersController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('users.profile', ['user' => $user]);
    }

    public function image(Request $request, User $user){

    $images = $request->images;

    if($images->isValid()) {
      $filePath = $images->store('public');
      $user->images = str_replace('public/', '', $filePath);
      $user->save();
      return redirect("/user/{$user->id}")->with('user', $user);

    }
 }

    //【検索】
    //検索機能//★
    public function search(Request $request){
        $keyword = $request->input('keyword');
        if(!empty($keyword)){
             $users = User::where('username','like', '%'.$keyword.'%')->get();
        }else{
             $users = User::all();
        }
        return view('users.search')->with(['users'=>$users,'keyword'=>$keyword
        ]);
        }

        //フォロー
        //$user = $request->following_id; //新しいユーザーを生成しない場合、userのidだけrequestして送っても良い
        //$user->users()->attach($followed_id); ////既存のユーザーのIDだけ送ったパターン
        //$user->detach($followed_id); //狙った１つのタグだけを外したい
        /*public function follow(Request $request, User $user){
            $request->user()->follow($user->id);
            return back();
        }*/
        //動画
        /*public function show(Request $request,$id){
            $user = User::find($id);
            return view('user.show',['user' => $user]);
        }*/

        //追加 プロフィール編集機能
        public function profileUpdate(Request $request, /*$id,*/User $user){
            //ddd($id);
            //ddd('check');

//①バリデーション
            $request->validate([
              'username' => 'required|min:2|max:12',
              'mail' => 'required|email|min:5|max:40|unique:users,mail,'.Auth::user()->mail.',mail',/*. $this->id,*///,
              'password' => 'confirmed|required|regex:/^[A-Za-z0-9]+$/u|min:8|max:20',
                'bio' => 'max:150',
                'file' => 'image',
                'images' => 'file|image',
                //'images'=>['file','mimes:jpeg,jpg,png,bmb'],
            ]);

            //try {
            $user = Auth::user();
            $id = Auth::id();

            $username = $request->input('username');
            //$user->mail = $request->input('mail');
            $mail = $request->input('mail');

            //$user->password = bcrypt($request->input('password'));//newpassword
            //$user->password = Hash::make($request->get('new-password'));
            //$user->password = $request->input('password');
            $password = $request->input('password');

            //$user->bio = $request->input('bio');
            $bio = $request->input('bio');

            //$user->images = basename($image);いらない

            /*$user = User::find(auth()->id());
            $user->images = basename($images);
            $user->save();*/

        //画像アップロード if文で画像必須をなくす
        //$request->('images');
        //if ($request->images === null) { //もし()
        //if ($request->images == null) {
        if ($request->file == null) {


            /*User::create([
          'username' => $request->username,
        ]);*/


/*$images = $request->file->store('public'); //ここは必要

$user = User::find(auth()->id());
            $user->images = basename($images);
            $user->save();*/


        \DB::table('users') //usersテーブルをここで更新
        ->where('id', $id) //これがないと全てのユーザー情報が上書きされてしまう
        ->update([
            //'username' => $user->username,
            'username' => $username,
            //'mail' => $user->mail,
            'mail' => $mail,
            //'password' => $user->password,
            'password' => bcrypt($password),
            //'bio' => $user->bio,
            'bio' => $bio,
            'images' => $user->images,
        ]

            //['username' => $username],
            //['mail' => $mail],
            // ['password' => bcrypt($password)],
            // ['bio' => $bio],
            //['images' => $images]
        );

        } else {

        $images = $request->file->store('public'); //ここは必要

            //if($image = null){ }
            //if($image != null){ }
            /*if ($path) {
                $user->update([
                    'images' => $path,
                ]);
            }*/
            /*User::create([
            'username' => $request->username,
          'description' => $request->description,
          'impression' => $request->impression,
          'images' => basename($images)
        ]);*/

/*②$user/*$id*//* = $request->input('id');
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = bcrypt($request->input('password'));
            $bio = $request->input('bio');
            $images = $request->input('images');
            //$user->update();
            $user->save();*/

/*③User::profileUpdate([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);*/

        /*$user = User::find($id);
    $user->update($request->all());
    return redirect()->route('index')
      ->with('success', 'user updated successfully.');*/
      $user = User::find(auth()->id());
            $user->images = basename($images);
            $user->save();

            \DB::table('users') //usersテーブルをここで更新
        ->where('id', $id) //これがないと全てのユーザー情報が上書きされてしまう
        ->update([
            //'username' => $user->username,
            'username' => $username,
            //'mail' => $user->mail,
            'mail' => $mail,
            //'password' => $user->password,
            'password' => bcrypt($password),
            //'bio' => $user->bio,
            'bio' => $bio,
            'images' => $user->images,
        ]

            //['username' => $username],
            //['mail' => $mail],
            // ['password' => bcrypt($password)],
            // ['bio' => $bio],
            //['images' => $images]
        );
    }

        /*if ($images) {
        $images->update([
        'images' => $images,
        ]);
        }*/

            /*$update = [
                'username' => 'join',
            ];
            User::where('id', $id)->update([$update]);*/
//④User::where('id', $id)->update([$update]);
            /*  'username' => $username,
              'price' => $up_price
            ]);*/
        /*} catch (\Exception $e) {
            return back()->with('msg_error', 'プロフィールの更新に失敗しました')->withInput();
        }*/

        /* function resetForm() {
	    form.password.value = '';
        } */

        /*try {
            $user = Auth::user();
            $user->name = $request->input('username');
            $user->save();
        } catch (\Exception $e) {
            return back()->with('msg_error', 'プロフィールの更新に失敗しました')->withInput();
        }

        return redirect()->route('/profile');/*->with('msg_success', 'プロフィールの更新が完了しました');*/

        //画像更新
        /*$image = $request->file('images');
        // $request->imgはformのinputのname='img'の値です
        // ->storeメソッドは別途説明記載します
        $path = $request->img->store('public/images');
        // パスから、最後の「ファイル名.拡張子」の部分だけ取得します 例)sample.jpg
        $images = basename($path);
        // FileImageをインスタンス化(実体化)します
        $data = new FileImage;
        // 登録する項目に必要な値を代入します
        $data->images = $images;
        $data->save(); // データベースに保存*/

        //$request->session()->put('images', $images); //セッションに保存

return redirect('/index');

    //}
    /*return view('/index');*/

    //追加 パスワード編集機能
    /*public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $user = Auth::user();
            $user->password = bcrypt($request->input('password'));
            $user->save();

        } catch (\Exception $e) {
            return back()->with('msg_error', 'パスワードの更新に失敗しました')->withInput();
        }

        return redirect()->route('articles_index')->with('msg_success', 'パスワードの更新が完了しました');

        } */

    }

    // フォロープロフ
    public function profiles($id){ //$id
        $member = User::find($id);
        //ddd($member);
        //$user_id = ？？？;//受け取ったidを$user_idに変換する。//id?

        $user = \DB::table('users');
        $user = User::select('users.username','posts.id','posts.post','posts.created_at','users.images','posts.user_id')//'posts.*','posts.user_id',
        ->leftJoin('posts', 'users.id', '=', 'posts.user_id') //テーブル結合
        ->where( 'users.id', '=' , $id )//$users_id?
        ->orderBy('created_at','desc')
        ->get();

        return view('users/profiles', ['user'=>$user, 'member'=>$member]); //ユーザー情報をビューに渡す//compact('member')
    }
}
