@extends('layouts.login')

@section('content')
<h2>フォロープロフ用</h2>

<p><img src="{{ asset('storage/'.$member->images) }}"></p>
<p>ユーザー名：{{ $member->username }}</p>
<p>自己紹介：{{ $member->bio }}</p>

@if (Auth::user()->isFollowing($member->id))
                <form action="{{ route('unfollow', ['user' => $member->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <td><button type="submit" class="btn btn-danger">フォロー解除</button></td>
                </form>
                @else
                <form action="{{ route('follow', ['user'=> $member->id]) }}" method="POST">
                @csrf
                <td><!--<input type="button" name="follow">-->
                <button type="submit" class="btn btn-primary">フォローする</button></td>
                </form>
@endif

@foreach($user as $user)
<p>{{ $user->created_at }}</p>
<p><img src="{{ asset('storage/'.$user->images) }}"></p>
<p>名前：{{ $user->username }}</p>
<p>投稿内容：{{ $user->post }}</p>
@endforeach
<!--★-->

@endsection
