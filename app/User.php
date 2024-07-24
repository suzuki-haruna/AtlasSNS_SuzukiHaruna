<?php

namespace App; //★

use Illuminate\Notifications\Notifiable;
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
