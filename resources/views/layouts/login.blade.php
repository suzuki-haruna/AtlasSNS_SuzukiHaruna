<!DOCTYPE html>
<html>
    <head><!--★-->
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"><!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script><!-- Bootstrap -->
    <!--<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>-->
    <script src="{{ asset('js/app.js') }}"></script> <!-- jQuery -->
    </head>

<body>
    <header>

            <div id = "head">
                <div class="header-wrapper">
                <div class="header-logo"><h1><a href="/index"><img src="images/atlas.png"></a></h1></div>
                    <div id=""></div>
                        <div id=""></div>

                        <!-- ヘッダー右 -->
                        <!-- <p>〇〇さん<img src="images/arrow.png"></p> ←ここでまとめておいたほうがいい可能性ある!?-->
                        <?php $user = Auth::user(); ?>
                        <div class="header-menu-name"><p>{{ $user->username }}さん</p></div>

                        <!-- メニュー -->
                        <div class="menu"></div>
                        <!--<span class="inn"></span>-->
                        <!--V-->

                        <nav>
                        <ul">
                        <li><a href="/index">ホーム</a></li>
                        <li><a href="/profile">プロフィール</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                        </ul>
                        </nav>
                        <!-- /メニュー -->

                        <div class="header-userimg"><img src="{{ asset('storage/'.Auth::user()->images) }}"></div>
                        <!-- /ヘッダー右 -->
            </div>
        </div>
    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ $user->username }}さんの</p>
                <div>
                <p>フォロー数</p>
                <p>{{ Auth::user()->followed()->count() }}名</p>
                <p></p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <!--{{url('follow-list')}}-->
                <div>
                <p>フォロワー数</p>
                <p>{{ Auth::user()->following()->count() }}名</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>

    <footer>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
