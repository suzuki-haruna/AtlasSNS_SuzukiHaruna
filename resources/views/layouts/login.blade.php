<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"><!--<meta charset="utf-8" />--><!--★-->
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title>Atlas SNS</title>
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

            <!-- ロゴ -->
            <!--<div id = "head">--><!--いらないかも-->
                <h1 class="header-logo"><a href="/index"><img src="{{ asset('storage/atlas.png') }}"></a></h1>
                <div id=""></div><div id=""></div>

                    <!-- ヘッダー右 -->
                    <div class="header-right">
                        <!-- ログインユーザー -->
                        <?php $user = Auth::user(); ?>
                        <div class="header-name">{{ $user->username }}　さん</div>

                        <!-- メニューjs -->
                        <div class="menu"></div>
                        <!--<span class="inn"></span>-->
                            <nav>
                            <ul>
                            <a href="/index"><li class="nav-white">HOME</li></a>
                            <a href="/profile"><li class="nav-navy">プロフィール編集</li></a>
                            <a href="/logout"><li class="nav-white">ログアウト</li></a>
                            </ul>
                            </nav>
                        <!-- /メニュー -->

                        <!--アイコン-->
                        <div class="header-icon"><img src="{{ asset('storage/'.Auth::user()->images) }}"></div>

                    </div>
                    <!-- /ヘッダー右 -->
            <!--</div>-->
    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">

            <div id="confirm">
                <p>{{ $user->username }}さんの</p>

                <table>
                <tr><td>フォロー数</td>
                <td class="follow-number">{{ Auth::user()->followed()->count() }}人</td>
                </tr>

                <tr>
                <td></td>
                <td><a href="/follow-list" class="btn btn-primary">フォローリスト</a></td>
                <!--{{url('follow-list')}}-->
                </tr>

                <tr>
                <td>フォロワー数</td>
                <td class="follow-number">{{ Auth::user()->following()->count() }}人</td>
                </tr>

                <tr>
                <td></td>
                <td><a href="/follower-list" class="btn btn-primary">フォロワーリスト</a></td>
                </tr>
                </table>

            </div>

            <a href="/search" class="btn btn-primary">ユーザー検索</a>

        </div>
    </div>

    <footer>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
