@extends('layouts.login')

@section('content')
<h2>フォロワーリスト</h2>
@foreach($follow_list as $follow_list)
<a href="/profiles"><img src="{{ asset('storage/'.$follow_list->images) }}"></a>
@endforeach

<!-- 投稿 -->
@foreach($posts as $post)
@if ($post->user_id !== Auth::user()->id)
<p>{{ $post->created_at }}</p>
<p><a href="/profiles"><img src="{{ asset('storage/'.$post->images) }}"></a></p>
<p>名前：{{ $post->username }}</p>
<p>投稿内容：{{ $post->post }}</p>
@endif
@endforeach

@endsection
<!--★-->
