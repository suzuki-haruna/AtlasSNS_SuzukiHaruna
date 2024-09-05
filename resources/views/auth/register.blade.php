@extends('layouts.logout')

<!-- バリデーションエラー -->
@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif

@section('content')

{!! Form::open(['url' => '/register']) !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }} <!--ユーザー名-->
{{ Form::text('username',null,['class' => 'input']) }}
<!-- {{ $errors->first('name') }} -->


{{ Form::label('メールアドレス') }} <!--メールアドレス-->
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('パスワード') }} <!--パスワード-->
{{ Form::text('password',null,['class' => 'input', 'input type' => 'password']) }}
<!-- 'input type' => 'password'-->

{{ Form::label('パスワード確認') }} <!--パスワード確認-->
{{ Form::text('password_confirmation',null,['class' => 'input', 'input type' => 'password']) }}

<!--{{ Form::submit('登録') }}-->
{{ Form::submit('新規登録',['class' => 'btn btn-danger']) }}
<!--'button type' => 'button',-->

<p class="back"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
