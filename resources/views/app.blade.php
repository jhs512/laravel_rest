<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>유니콘 - @yield('title')</title>
    <link href="{{ asset('css/app_1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app_2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- 부트스트랩 CSS 는 css/app.css 에 포함되어 있습니다. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</head>

<body class="t-flex t-flex-col t-min-h-screen">
    <header class="t-top-bar t-fixed t-top-0 t-left-0 t-w-full t-z-50 t-h-10 t-shadow t-text-gray-500 t-bg-white t-pr-2">
        <div class="t-container t-mx-auto t-h-full t-flex">
            <a href="{{ route('home') }}" class="t-flex t-items-center t-px-4">
                <i class="fas fa-horse-head"></i>
                <span class="t-hidden sm:t-block">&nbsp;</span>
                <span class="t-hidden sm:t-block t-pt-1">유니콘</span>
            </a>
            <div class="t-flex-grow"></div>
            <nav class="menu-1">
                <ul class="t-flex t-h-full">
                    <li class="{{ Route::currentRouteName() == 'home' ? 't-text-[#0A58CA]' : '' }}">
                        <a href="{{ route('home') }}" class="t-h-full t-flex t-items-center px-2">
                            <i class="fas fa-home"></i>
                            <span class="t-hidden sm:t-block">&nbsp;</span>
                            <span class="t-hidden sm:t-block t-pt-1">홈</span>
                        </a>
                    </li>
                    <li
                        class="{{ (Str::startsWith(Route::currentRouteName(), 'articles.') and!Str::startsWith(Route::currentRouteName(), 'articles.create'))? 't-text-[#0A58CA]': '' }}">
                        <a href="{{ route('articles.index') }}" class="t-h-full t-flex t-items-center px-2">
                            <i class="fas fa-list"></i>
                            <span class="t-hidden sm:t-block">&nbsp;</span>
                            <span class="t-hidden sm:t-block t-pt-1">글</span>
                        </a>
                    </li>
                    @can('create', App\Models\Article::class)
                        <li
                            class="{{ Str::startsWith(Route::currentRouteName(), 'articles.create') ? 't-text-[#0A58CA]' : '' }}">
                            <a href="{{ route('articles.create') }}" class="t-h-full t-flex t-items-center px-2">
                                <i class="fas fa-pen"></i>
                                <span class="t-hidden sm:t-block">&nbsp;</span>
                                <span class="t-hidden sm:t-block t-pt-1">작성</span>
                            </a>
                        </li>
                    @endcan
                    @guest
                        <li class="{{ Route::currentRouteName() == 'register' ? 't-text-[#0A58CA]' : '' }}">
                            <a href="{{ route('register') }}" class="t-h-full t-flex t-items-center px-2">
                                <i class="fas fa-user-plus"></i>
                                <span class="t-hidden sm:t-block">&nbsp;</span>
                                <span class="t-hidden sm:t-block t-pt-1">회원가입</span>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'login' ? 't-text-[#0A58CA]' : '' }}">
                            <a href="{{ route('login') }}" class="t-h-full t-flex t-items-center px-2">
                                <i class="fas fa-sign-in-alt"></i>
                                <span class="t-hidden sm:t-block">&nbsp;</span>
                                <span class="t-hidden sm:t-block t-pt-1">로그인</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="#" class="t-h-full t-flex t-items-center px-2">
                                <i class="far fa-user"></i>
                                <span class="t-hidden sm:t-block">&nbsp;</span>
                                <span class="t-hidden sm:t-block t-pt-1">
                                    {{ Auth::user()->name }}'s 마이페이지
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="t-h-full t-flex t-items-center px-2"
                                onclick="document.logout_form.submit(); return false;">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="t-hidden sm:t-block">&nbsp;</span>
                                <span class="t-hidden sm:t-block t-pt-1">로그아웃</span>
                            </a>
                            <form method="POST" name="logout_form" action="{{ route('logout') }}" class="t-hidden">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>

    <!-- 상단바의 높이만큼 -->
    <div class="t-h-10"></div>

    @include('flash-message')

    <main class="t-flex-grow t-flex t-flex-col">
        @yield('content')
    </main>
</body>

</html>
