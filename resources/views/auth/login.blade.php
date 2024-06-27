@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}

<p class="login-welcome">AtlasSNSへようこそ</p>

{{ Form::label('mail adress') }} <!-- e-mail -->
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

<!-- {{ Form::submit('ログイン') }} -->
{{ Form::submit('LOGIN',['class' => 'btn btn-danger']) }}
<!-- <button type="button" class="btn btn-danger">Danger</button> -->
<!--button type' => 'button',-->

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
