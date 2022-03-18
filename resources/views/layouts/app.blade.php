<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aureola') }}</title>
    <link rel="icon" href="{{ asset('/favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- fontAwesome6でアイコン取得 -->
    <script src="https://kit.fontawesome.com/1646a14d8e.js" crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forum.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Aureola') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if(Auth::check())
                    <ul class="navbar-nav me-auto">
                        <!-- メニューバー追加 -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <!-- みんなの投稿 -->
                            <i class="fas fa-home pr-2">
                            みんなの投稿
                            </i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{url()->current()==route('home')? 'active' : ''}}" href="{{ route('home') }}">
                                    <!-- <i class="fas fa-home pr-2"> -->
                                    出来事の投稿
                                    <!-- </i> -->
                                </a>
                                <a class="dropdown-item {{url()->current()==route('todo-post.index')?'active':''}}" href="{{ route('todo-post.index') }}">
                                    <!-- <i class="fas fa-fire"> -->
                                    Todoの投稿
                                    <!-- </i> -->
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <!-- 投稿の作成 -->
                                <i class="fas fa-pen-nib pr-2">
                                新規投稿
                                </i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{url()->current()==route('incident-post.create')? 'active' : ''}}" href="{{ route('incident-post.create') }}">
                                    <!-- <i class="fas fa-pen-nib pr-2"> -->
                                        出来事の新規投稿
                                    <!-- </i> -->
                                </a>
                                <a class="dropdown-item {{url()->current()==route('todo-post.create')?'active':''}}" href="{{ route('todo-post.create') }}">
                                    <!-- <i class="fas fa-pen-nib pr-2"> -->
                                        Todoの新規投稿
                                    <!-- </i> -->
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <!-- 自分の投稿 -->
                                <i class="fas fa-user-edit pr-2">
                                自分の投稿
                                </i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{url()->current()==route('home.mypost')?'active':''}}" href="{{ route('home.mypost') }}">
                                    <!-- <i class="fas fa-user-edit pr-2"> -->
                                    出来事の投稿
                                    <!-- </i> -->
                                </a>
                                <a class="dropdown-item {{url()->current()==route('todo-post.mypost')?'active':''}}" href="{{ route('todo-post.mypost') }}">
                                    <!-- <i class="fas fa-user-edit pr-2"> -->
                                    Todoの投稿
                                    <!-- </i> -->
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <!-- アクションした投稿 -->
                                <i class="fas fa-light fa-solid fa-heart">
                                myアクション
                                </i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{url()->current()==route('home.mycomment')?'active':''}}" href="{{ route('home.mycomment') }}">
                                    <!-- <i class="fas fa-light fa-comments pr-2"> -->
                                        コメントした投稿
                                    <!-- </i> -->
                                </a>
                                <a class="dropdown-item {{url()->current()==route('home.myFavorite')?'active':''}}" href="{{ route('home.myFavorite') }}">
                                    <!-- <i class="fas fa-light fa-solid fa-heart"> -->
                                        お気に入りした投稿
                                    <!-- </i> -->
                                </a>
                            </div>
                        </li>
                    </ul>
                    @endif
                    <!-- 管理者用ページ -->
                    @can('admin')
                    <a href="{{route('profile.index')}}"
                    class=" {{url()->current()==route('profile.index')?'active':''}}">
                        <i class="fas fa-user-edit pr-2" style="color: #686b68;"></i><span>ユーザーアカウント</span>
                    </a>
                    @endcan


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <!-- ログインユーザーのプロフィール画像も表示 -->
                                <img src="{{asset('storage/avatar/'.($user->avatar??'user_default.jpg'))}}"
                                    class="rounded-circle" style="width:40px;height:40px;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <!-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div> -->

                                <!-- メニューバー項目 -->
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!-- プロフィール編集バー追加 -->
                                    <a class="dropdown-item" href="{{ route('profile.edit', auth()->user()->id) }}">
                                        <!-- <i class="fas fa-solid fa-address-card"></i> -->
                                        <i class="fas fa-user-edit"></i>
                                        プロフィール編集
                                    </a>
                                    <!-- ログアウトバー -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-sign-out-alt"></i>
                                        {{ __('ログアウト') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(Auth::check())
            <div class="container">
                {{-- メイン（投稿一覧の表示） --}}
                @yield('content')
            </div>
            @else
            @yield('content')
            @endif
        </main>

    </div>
</body>
</html>
