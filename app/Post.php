<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['post','user_id'];
    //public $fillable = ['user_id', 'post']; //書き込み可能[post] 必須項目 $guarded or $fillable
    //★
    //protected $posts = 'posts';
    //
    /*public function user(){
        return $this->belongsTo('App\User');
    }*/
}
