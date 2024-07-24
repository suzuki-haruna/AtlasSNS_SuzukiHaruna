@extends('layouts.login')

@section('content')

<div class="search">
  <form action="/search" method="post">
           @csrf
           <input type="text" name="keyword" class="form" placeholder="ユーザー名">
           <button type="submit" class="btn btn-success pull-right"><img src="images/search.png" alt="送信"></button>
  </form>

          @if(!empty($keyword))
          検索したワード：{{ $keyword }}
          @else
          @endif
</div>

<!-- ユーザー一覧 -->
        <table class="table table-hover">
            @foreach ($users as $user)
            @if ($user->id !== Auth::user()->id) <!-- 自分は表示しない -->
            <tr>
                <td><img src="{{ asset('storage/'.Auth::user()->images) }}"></td><!-- {{ $user->images }} -->
                <td>{{ $user->username }}</td>
            </tr>

            @endif
            @endforeach
        </table>
<!-- /ユーザー一覧 -->

@endsection
