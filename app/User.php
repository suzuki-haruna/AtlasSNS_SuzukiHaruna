<?php

namespace App;

use Illuminate\Notifications\Notifiable;//★
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth; //追加 フォローフォロワー
use Illuminate\Database\Eloquent\Model; //追加 プロフィール編集
//use Illuminate\Support\Facades\Hash; //ハッシュ追加

//追加 プロフィール編集
/*class User extends Model
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

    //フォロー リレーション
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }
    //フォロー解除 リレーション
    public function followed()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }
    //フォローする
    public function follow($user_id)
    {
        return $this->following()->attach($user_id);
    }
    //フォロー解除
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }
    //フォローしているか
    public function isFollowing($user_id)
    {
        return (boolean) $this->followed()->where('followed_id', $user_id)->first();
    }
    //フォローされているか
    public function isFollowed(User $user)
    {
        return (bool) $this->following()->where('following_id', $user->id)->exists();
    }

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
}
