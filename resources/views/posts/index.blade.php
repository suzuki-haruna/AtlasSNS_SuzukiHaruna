@extends('layouts.login')

@section('content')

<!-- 追加 -->

<!-- 投稿する -->
  {!! Form::open(['url' => 'index']) !!} <!-- indexに値を送る -->
  {{ Form::token() }}
<div class="container">
  <img src="{{ asset('storage/'.Auth::user()->images) }}">

  <div class="post-form">
  {{-- Form::input('text', 'newPost', null,['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください', 'rows' => '10']) --}}
    {{ Form::textarea('newPost', null,['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。', 'rows' => '4']) }}
  </div>

  <button type="submit" class="post-btn"><img src="images/post.png" alt="送信"></button>
</div><!--☆-->
<!-- <form action="/index" method="POST">
@csrf --> <!-- 送信されるデータを保護する -->
<!--@method('PUT')-->
<!-- <label for="post">投稿</label>
<textarea name="post"></textarea>
<input type="submit" value="Submit">
</form> -->

{!! Form::close() !!}
<hr class="post-hr">

<!-- 投稿 -->
@foreach($posts as $post)
<div class="posts">

<img src="{{ asset('storage/'.$post->images) }}" class="posts-icon">

<ul>
<li><b>{{ $post->username }}</b></li>
<li class="posts-post">{{ $post->post }}</li>
</ul>

<div class="posts-day">
{{ $post->created_at->format('Y-m-d H:i') }}
</div>

@if ($post->user_id == Auth::user()->id)
<div class="posts-edit">
<!-- 投稿編集 -->
<a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集"></a>
<!--<button type="submit" class="btn btn-success pull-right"><img src="images/edit.png" alt="送信"></button>-->

<!-- 削除 -->
<button type="submit" class="btn"><a href="/index/{{$post->id}}/delete" class="modal-delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img src="images/trash.png" onMouseOver="this.src='images/trash-h.png'" onMouseOut="this.src='images/trash.png'" alt="削除"></a></button>
</div>
@else
@endif

</div>
<hr>
@endforeach

<!-- モーダルの中身 -->
<!--更新ボタンを押す　→　モーダル画面が表示される　→　更新する内容を入力して更新ボタンを押す　→　投稿のテーブルが更新され、トップページに戻る。-->
<!--index.blade.phpのモーダル中身、web.php、PostsControllerの記述が必要-->
<!--①更新ボタンを押した時に、どのURLに遷移するのか、また、更新をするためにどんなデータを送る必要があるのかを考え、記述をする-->
<!--②web.phpにURLと合わせてどのControllerのどのメソッドの処理をするのかを記述し、Controllerに実際に更新する処理を記述する-->
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <form action="/post/update" method="post">
            <textarea name="upPost" class="modal_post" maxlength="150" required></textarea><!--name属性を追記。ここは送るデータに名前を付けているだけなので、受け取る側(Controller側)と一致していればなんでも可--><!--編集したい投稿の内容を送っている--><!--★-->
            <input type="hidden" name="id" class="modal_id" value=""><!--name属性を追記。ここは送るデータに名前を付けているだけなので、受け取る側(Controller側)と一致していればなんでも可--><!--どの投稿を編集したいのかを特定するidを送っている-->
            <!--<input type="submit" value="更新">-->
            <div  class="modal-btn">
            <button type="submit" class="btn"><img src="images/edit.png" alt="送信"></button>
            {{ csrf_field() }}
            </div>
        </form>
        <!--<a class="js-modal-close" href="">閉じる</a>-->
    </div>
</div>

<!-- /追加 -->

@endsection
