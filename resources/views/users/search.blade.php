@extends('layouts.login')

@section('content')

<div class="search">
  <form action="/search" method="post">
           @csrf
           <input type="text" name="keyword" class="form" placeholder="ユーザー名">
           <button type="submit" class="btn btn-success pull-right"><img src="images/search.png" alt="送信"></button>
  </form>
          @if(!empty($keyword)) <!-- もし、空ではなかったら。 --><!--★-->
          検索したワード：{{ $keyword }}
          @else
          @endif
</div>

<!--テスト-->
                {!! Form::open(['url' => '/follows/create']) !!}<!--フォームの値を送る-->
                {{Form::token()}}<!--CSRFトークン-->
                <div class="">
                {{ Form::input('submit', 'followId', null, ['class' => 'form-control']) }}
                </div>
                <button type="submit" class="btn btn-success pull-right">テスト</button>
                {!! Form::close() !!}

<!-- ユーザー一覧 -->
        <table class="table table-hover">
            @foreach ($users as $user)
            @if ($user->id !== Auth::user()->id) <!-- 自分は表示しない -->
            <tr>
                <td><img src="{{ asset('storage/'.Auth::user()->images) }}"></td><!-- {{ $user->images }} -->
                <td>{{ $user->username }}</td>

                <!-- フォロー -->
                @if (Auth::user()->isFollowing($user->id))
                <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <td><button type="submit" class="btn btn-danger">フォロー解除</button></td>
                </form>
                @else
                <form action="{{ route('follow', $user->id) }}" method="POST">
                @csrf
                <td><!--<input type="button" name="follow">-->
                <button type="submit" class="btn btn-primary">フォローする</button></td>
                </form>

                @endif

            </tr>
            @endif
            @endforeach
        </table>
<!-- /ユーザー一覧 -->
<!--ここのurl指定方法の考え方は投稿の編集機能と似ています。
ただ編集機能はフォームファサードを使った書き方、今回は別の書き方で書いています。
そのため下記のような記述で記載してみましょう。
<form action="｛｛(小文字に戻す) url('search/follow/'.＄(小文字に戻す)〇〇->id) ｝｝" method="POST">-->

@endsection
