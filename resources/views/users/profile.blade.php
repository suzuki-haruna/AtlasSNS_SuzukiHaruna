@extends('layouts.login')

@section('content')

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

{!! Form::open(['url' => '/profile', 'files' => true]) !!}<!--/index!?-->
@method('PUT')
@csrf
{{Form::hidden('id',Auth::user()->id)}}

<!--{!! Form::open(['route' => ['profile_edit'], 'method' => 'PUT']) !!}-->
<!--{!! Form::hidden('id',$user->id) !!}-->

@if($user->images == null)
<img src="/storage/icon2.png">
@else
<img src="/storage/{{$user->images}}">
@endif

<!--<img src="{{$user->images}}">
{{Form::label('username','ユーザー名')}}
{{Form::text('username', $user->username, ['class' => 'form-control', 'id' =>'username'])}}
<span class="text-danger">{{$errors->first('name')}}</span>-->

{{ Form::label('ユーザー名') }}
{{ Form::text('username', value($user->username), ['class' => 'form-control', 'id' =>'name']) }}

{{ Form::label('メールアドレス') }}
{{ Form::email('mail', value($user->mail),['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input', 'input type' => 'password']) }}

{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input', 'input type' => 'password']) }}

{{ Form::label('自己紹介') }}
{{ Form::text('bio', value($user->bio),['class' => 'input']) }}

{!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
{!! Form::file('file') !!}
<!--{{ Form::label('アイコン画像') }}
{{ Form::file('images',null,['class' => 'input']) }}--><!--img→images!?/null-->
<!--①HTMLのformタグを使用する場合は、"enctype" => "multipart/form-data"を追加するが、Formファサードの場合は、'files' => true が必要
②Form::fileの第1引数はname属性になるので、Controller側と一致させる-->

{{ Form::submit('更新',['class' => 'btn btn-danger']) }}

{{Form::token()}}
{!! Form::close() !!}

@endsection
