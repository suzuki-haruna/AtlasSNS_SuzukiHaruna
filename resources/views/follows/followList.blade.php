@extends('layouts.login')

@section('content')
<h2>フォローリスト</h2>
@foreach($follow_list as $follow_list)
<a href="{{ route('profiles', ['id' => $follow_list->id]) }}"><img src="{{ asset('storage/'.$follow_list->images) }}"></a>
@endforeach

<!-- 投稿 -->
@foreach($posts as $post)
@if ($post->user_id !== Auth::user()->id)
<p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
<p><a href="{{ route('profiles', ['id' => $post->user_id]) }}"><img src="{{ asset('storage/'.$post->images) }}"></a></p>
<p>名前：{{ $post->username }}</p>
<p>投稿内容：{{ $post->post }}</p>
@endif
@endforeach

@endsection
<!--★-->
