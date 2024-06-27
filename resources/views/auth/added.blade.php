@extends('layouts.logout')

@section('content')

<div id="clear">
  <p class="add-name">{{ session('username') }}さん</p>
  <p class="add-welcome">ようこそ！AtlasSNSへ</p>
  <p class="add-message">ユーザー登録が完了しました。</p>
  <p class="add-message">早速ログインをしてみましょう！</p>

  <!--<p class="btn"><a href="/login">ログイン画面へ</a></p>-->
  <div class="add-btn">
  <button type="button" class="btn btn-danger"><a href="/login">ログイン画面へ</a></button>
</div>
</div>

@endsection
