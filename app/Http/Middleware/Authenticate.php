<?php

namespace App\Http\Middleware;
//<名前空間>

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
/*
    //追加 04ログイン後に表示するページにアクセス制限をかける
    // リクエスト処理
    public function handle($request, Closure $next)
    //<アクセス修飾子>
    {
        $response = $next($request);
        $data = [
    ['mail'=>$mail, 'password'=>$password],
    ];
    $request->merge(['data'=>$data]);

        // トークンが一致しなければリダイレクト
        /*if ($request->input('token') !== 'my-secret-token') {
            return redirect('login');
        }

        // アプリケーションに進む
        // (ミドルウェアをパスする)*/
//        return $next($request);
//    }
}

//追加 04ログイン後に表示するページにアクセス制限をかける
/*
class Authenticate
{
    // リクエスト処理
    public function handle($request, Closure $next)
    {
        // トークンが一致しなければリダイレクト
        if ($request->input('token') !== 'my-secret-token') {
            return redirect('login');
        }

        // アプリケーションに進む
        // (ミドルウェアをパスする)
        return $next($request);
    }
}
*/
