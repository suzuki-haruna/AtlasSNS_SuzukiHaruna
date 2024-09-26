@extends('layouts.login')

@section('content')

<div class="profiles">
    <div class="profiles-icon"><img src="{{ asset('storage/'.$member->images) }}"></div>

    <table class="profiles-user">
    <tr><td class="profiles-table">ユーザー名</td><td class="profiles-table2">{{ $member->username }}</td></tr>
    <tr><td class="profiles-table">自己紹介</td><td class="profiles-table2">{{ $member->bio }}</td></tr>
    </table>

    <div class="profiles-follow">
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
    </div>
</div>
<hr class="post-hr">

@foreach($user as $user)
<div class="posts">

<img src="{{ asset('storage/'.$user->images) }}" class="posts-icon">

<ul>
<li><b>{{ $user->username }}</b></li>
<li class="posts-post">{{ $user->post }}</li>
</ul>

<div class="posts-day">
{{ $user->created_at->format('Y-m-d H:i') }}
</div>

</div>
<hr>
@endforeach
<!--★-->

@endsection
