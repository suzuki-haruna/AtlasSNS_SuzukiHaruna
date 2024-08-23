<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth; //追加 フォローフォロワー
use Illuminate\Database\Eloquent\Model; //プロフィール編集

//追加 プロフィール編集
/*class User extends Model //Modelクラス(紐づけたいテーブルに対して単数形で書く)複数存在できない!?//★
{
    //
    use HasFactory;
    protected $fillable = ['username', 'mail'];
}*/

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
        'following_id', 'followed_id' //テスト
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //追加 フォロー
    /*public function users()
    {
        return $this->belongsToMany('App\User'); //userに属するuserを取得
    }*/
    /*public function users()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }*/

    //！フォロー リレーション◎
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id'); //User::class self::class
    }
    public function followed()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id',);
    }
    //！フォローする
    public function follow($user_id)
    {
        return $this->followed()->attach($user_id);
    }

    //フォロー解除
    public function unfollow($user_id) //Int
    {
        return $this->followed()->detach($user_id);
    }
    //フォローしているか
    public function isFollowing($user_id)
    {
        return (boolean) $this->followed()->where('followed_id', $user_id)->first();
    }
    //フォローされているか
    public function isFollowed($user_id)
    {
        return (boolean) $this->following()->where('following_id', $user->id);//->first(['id']);
    }
    //followers=following follows=followed

    public function followPost(){
        $followPost = $this->followed()->pluck('users.id')->toArray(); //ユーザがフォロー中のユーザを取得
        return $followPost; //フォロー中のユーザを返す
    }

    //リレーション
    /*public function posts(){
        return $this->hasMany('App\Post');
    }*/

    //追加 プロフィール編集機能
    public function updateAll() {
    users::where('username', '!=', 'null')->update([
        'username' => $user,
        //'color' => 'yellow',
        //'price' => '200',
    ]);
}

    /*public function user($password)
    //usersテーブルにデータを登録する。
    {
        return $this->create([
            'password'     => Hash::make($password), //ハッシュ
        ]);
    }*/

    //テスト
    /*class User extends Model{
    protected $fillable = [
        'following_id', 'followed_id'
    ];*/
    //リレーション
    /*public function follows(){
        return $this->hasMany('App\Follow');
    }*/
    }
