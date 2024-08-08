@extends('layouts.login')

@section('content')

<!-- 追加 -->

<!-- 投稿の編集 -->
<div class="container">

  {!! Form::open(['url' => 'index']) !!} <!-- indexに値を送る -->
  {{ Form::token() }}<!--★-->

<img src="{{ asset('storage/'.Auth::user()->images) }}">

<div class="post-form">
  {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) }}
</div>

<button type="submit" class="btn btn-success pull-right"><img src="images/post.png" alt="送信"></button>

<!-- <form action="/index" method="POST">
@csrf --> <!-- 送信されるデータを保護する -->
<!--@method('PUT')-->
<!-- <label for="post">投稿</label>
<textarea name="post"></textarea>
<input type="submit" value="Submit">
</form> -->

{!! Form::close() !!}
</div>

<!-- モーダルの中身 -->
<!--    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
           <form action="" method="">
                <textarea name="" class="modal_post"></textarea>
                <input type="hidden" name="" class="modal_id" value="">
                <input type="submit" value="更新">
                {{ csrf_field() }}
           </form>
           <a class="js-modal-close" href="">閉じる</a>
        </div>
    </div> -->

@foreach($posts as $post)
<?php $user = Auth::user(); ?>
@if($user)
<p>テスト：{{ $user->mail }}</p>
<p>名前：{{ $post->username }}</p>
<p>投稿内容：{{ $post->post }}</p>
@else
@endif
@endforeach

<!-- /追加 -->

@endsection
