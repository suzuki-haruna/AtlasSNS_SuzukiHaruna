@extends('layouts.login')

@section('content')

<form action="/search" method="post">
           @csrf
           <input type="text" name="search" class="form" placeholder="ユーザー名">
           <button type="submit" class="btn btn-success pull-right"><img src="images/search.png" alt="送信"></button>

          </form>

@endsection
