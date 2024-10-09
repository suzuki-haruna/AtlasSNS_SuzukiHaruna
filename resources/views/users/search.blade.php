@extends('layouts.login')

@section('content')

<div class="search">
  <form action="/search" method="post">
           @csrf
           <input type="text" name="keyword" class="form" placeholder="ユーザー名">
           <button type="submit" class="post-btn"><img src="images/search.png" alt="送信"></button>
            <!--class="btn btn-success pull-right"-->
  </form>
  <div class="keyword">
          @if(!empty($keyword)) <!-- もし、空ではなかったら。 --><!--★-->
          検索ワード：{{ $keyword }}
          @else
          @endif
    </div>
</div>
<hr class="post-hr">

<!-- ユーザー一覧 -->
    <div class="search-user">
    <table class="table">
    <!--<table class="table table-hover">-->
            @foreach ($users as $user)
            @if ($user->id !== Auth::user()->id) <!-- 自分は表示しない -->
            <tr class="table-user">
                <td class="search-icon"><img src="{{ asset('storage/'.$user->images) }}" onerror="this.onerror=null; this.src='{{asset('/images/icon1.png')}}';"></td><!-- {{ $user->images }} --><!--{{ asset('storage/'.Auth::user()->images) }}-->
                <td class="search-name">{{ $user->username }}</td>

                <!-- フォロー -->
                @if (Auth::user()->isFollowing($user->id))
                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <td><button type="submit" class="btn btn-danger">フォロー解除</button></td>
                </form>
                @else
                <form action="{{ route('follow', ['user'=> $user->id]) }}" method="POST">
                <!--{{ route('follow', $user->id) }}-->
                @csrf
                <td><!--<input type="button" name="follow">-->
                <button type="submit" class="btn btn-info">フォローする</button></td>
                </form>

                @endif

            </tr>
            @endif
            @endforeach
    </table>
    </div>
<!-- /ユーザー一覧 -->
<!--ここのurl指定方法の考え方は投稿の編集機能と似ています。
ただ編集機能はフォームファサードを使った書き方、今回は別の書き方で書いています。
そのため下記のような記述で記載してみましょう。
<form action="｛｛(小文字に戻す) url('search/follow/'.＄(小文字に戻す)〇〇->id) ｝｝" method="POST">-->

@endsection
