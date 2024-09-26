@extends('layouts.login')

@section('content')

<div class="follow-list">
  <h2>フォロワーリスト</h2>

  <div class="follow-list-user">
  @foreach($follow_list as $follow_list)
  <a href="{{ route('profiles', ['id' => $follow_list->id]) }}"><img src="{{ asset('storage/'.$follow_list->images) }}"></a>
  @endforeach
  </div>
</div>

<hr class="post-hr">

<!-- 投稿 -->
@foreach($posts as $post)
@if ($post->user_id !== Auth::user()->id)

<div class="posts">

<a href="{{ route('profiles', ['id' => $post->user_id]) }}"><img src="{{ asset('storage/'.$post->images) }}" class="posts-icon"></a>

<ul>
<li><b>{{ $post->username }}</b></li>
<li class="posts-post">{{ $post->post }}</li>
</ul>

<div class="posts-day">
<p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
</div>
</div><hr>

@endif
@endforeach

@endsection
<!--★-->
