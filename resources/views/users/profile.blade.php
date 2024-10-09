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

<div class="profile-wrapper">
<table class="profile">
{!! Form::open(['url' => '/profile', 'files' => true]) !!}<!--/index!?-->
@method('PUT')
@csrf
{{Form::hidden('id',Auth::user()->id)}}

<!--{!! Form::open(['route' => ['profile_edit'], 'method' => 'PUT']) !!}-->
<!--{!! Form::hidden('id',$user->id) !!}-->

<tr><td class="profile-icon">
@if($user->images == null)
<img src="/storage/icon1.png">
@else
<img src="/storage/{{$user->images}}" onerror="this.onerror=null; this.src='{{asset('/images/icon1.png')}}';">
@endif
</td>

<!--<img src="{{$user->images}}">
{{Form::label('username','ユーザー名')}}
{{Form::text('username', $user->username, ['class' => 'form-control', 'id' =>'username'])}}
<span class="text-danger">{{$errors->first('name')}}</span>-->

<td class="profile-label">{{ Form::label('ユーザー名') }}</td>
<td>{{ Form::text('username', value($user->username), ['class' => 'input', 'id' =>'name']) }}</td>
{{-- Form::text('username', value($user->username), ['class' => 'form-control', 'id' =>'name']) --}}
</tr>

<tr><td></td>
<td class="profile-label">{{ Form::label('メールアドレス') }}</td>
<td>{{ Form::email('mail', value($user->mail),['class' => 'input']) }}</td>
</tr>

<tr><td></td>
<td class="profile-label">{{ Form::label('パスワード') }}</td>
<td>{{ Form::text('password',null,['class' => 'input', 'input type' => 'password']) }}</td>
</tr>

<tr><td></td>
<td class="profile-label">{{ Form::label('パスワード確認') }}</td>
<td>{{ Form::text('password_confirmation',null,['class' => 'input', 'input type' => 'password']) }}</td>
</tr>

<tr><td></td>
<td class="profile-label">{{ Form::label('自己紹介') }}</td>
<td>{{ Form::text('bio', value($user->bio),['class' => 'input']) }}</td>
</tr>

<tr><td></td>
<td class="profile-label">{!! Form::label('file', 'アイコン画像', ['class' => 'control-label']) !!}</td>
<td class="profile-label3">{!! Form::label('file', 'ファイルを選択', ['class' => 'control-label2']) !!}
  <img id="icon_img_prv" class="prv" src="{{ asset('/storage/prv2.png') }}">
{!! Form::file('file', ['class' => 'icon-Registration']) !!}</td>
</tr>
<!--{{ Form::label('アイコン画像') }}
{{ Form::file('images',null,['class' => 'input']) }}--><!--img→images!?/null-->
<!--①HTMLのformタグを使用する場合は、"enctype" => "multipart/form-data"を追加するが、Formファサードの場合は、'files' => true が必要
②Form::fileの第1引数はname属性になるので、Controller側と一致させる-->

<!--テスト プレビュー-->
<!--<tr><td><img id="icon_img_prv" class="img-thumbnail h-25 w-25 mb-3" src="{{ asset('/storage/icon1.png') }}"></td></tr>-->

<tr><td class="profile-footer">{{ Form::submit('更新',['class' => 'btn btn-danger']) }}</td></tr>

{{Form::token()}}
{!! Form::close() !!}
</table>
</div>

<script>
    // アイコン画像プレビュー処理
    // 画像が選択される度に、この中の処理が走る
    $('#file').on('change', function (ev) {
        // このFileReaderが画像を読み込む上で大切
        const reader = new FileReader();
        // ファイル名を取得
        const fileName = ev.target.files[0].name;
        // 画像が読み込まれた時の動作を記述
        reader.onload = function (ev) {
            $('#icon_img_prv').attr('src', ev.target.result).css('width', '50px').css('height', '50px');
        }
        reader.readAsDataURL(this.files[0]);
    })
</script>

@endsection
