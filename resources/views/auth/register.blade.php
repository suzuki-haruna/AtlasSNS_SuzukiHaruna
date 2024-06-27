@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('user name') }} <!--ユーザー名-->
{{ Form::text('username',null,['class' => 'input']) }}
<!-- {{ $errors->first('name') }} -->


{{ Form::label('mail adress') }} <!--メールアドレス-->
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('password') }} <!--パスワード-->
{{ Form::text('password',null,['class' => 'input', 'input type' => 'password']) }}
<!-- 'input type' => 'password'-->

{{ Form::label('password confirm') }} <!--パスワード確認-->
{{ Form::text('password_confirmation',null,['class' => 'input', 'input type' => 'password']) }}

<!--{{ Form::submit('登録') }}-->
{{ Form::submit('REGISTER',['class' => 'btn btn-danger']) }}
<!--'button type' => 'button',-->

<p class="back"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
