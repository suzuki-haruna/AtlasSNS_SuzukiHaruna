<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//追加 プロフィール編集
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    //
    public function profile(){
        $user = Auth::user();
        return view('users.profile', ['user' => $user]);
    }
    /*    public function profile(){
        return view('users.profile');
    } */

    public function image(Request $request, User $user) {

  $images = $request->images;

    if($images->isValid()) {
      $filePath = $images->store('public');
      $user->images = str_replace('public/', '', $filePath);
      $user->save();
      return redirect("/user/{$user->id}")->with('user', $user);

    }
 }

    //【検索】
    //ユーザー一覧
    /*public function search(){
        $users = User::get(); //Userモデル(usersテーブル)からレコード情報を取得
        return view('users.search',['users'=>$users]); //viewヘルパ(指定したphpファイルを画面に表示する)
    }*/

    //検索機能
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if(!empty($keyword)){
             $users = User::where('username','like', '%'.$keyword.'%')->get();
        }else{
             $users = User::all();
        }
        return view('users.search')->with(['users'=>$users,'keyword'=>$keyword
        ]);
    }

    //追加 プロフィール編集機能
    public function profileUpdate(Request $request, $id/*, User $user*/){

        //バリデーション
            $request->validate([
              'username' => 'required|min:2|max:12',
              'mail' => 'required|unique:users,mail|email|min:5|max:40,' . $this->id,
              'password' => 'required|regex:/^[A-Za-z0-9]+$/u|min:8|max:20','confirmed',
                'bio' => 'max:150',
                'images' => 'file|image',
            ]);

        /*try*/ //{
            //$user = Auth::user();
            $id = $request->input('id');
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = bcrypt($request->input('password'));
            $bio = $request->input('bio');
            $images = $request->input('images');
            //$user->update();
            $user->save();

            User::profileUpdate([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);
        /*$user = User::find($id);
    $user->update($request->all());
    return redirect()->route('index')
      ->with('success', 'user updated successfully.');*/

            /*\DB::table('users')
        ->where('id', $id)
        ->update(
            ['username' => $username],
            ['mail' => $mail],
            // ['password' => bcrypt($password)],
            // ['bio' => $bio],
            ['images' => $images]
        );*/

            /*$update = [
                'username' => 'join',
            ];
            User::where('id', $id)->update([$update]);*/
            User::where('id', $id)->update([$update]);
            /*  'username' => $username,
              'price' => $up_price
            ]);*/
        /*} catch (\Exception $e) {
            return back()->with('msg_error', 'プロフィールの更新に失敗しました')->withInput();
        }*/

        /* function resetForm() {
	    form.password.value = '';
        } */

        //return redirect()->route('/index')/*->with('msg_success', 'プロフィールの更新が完了しました');*/
        return redirect('profile');

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
}
