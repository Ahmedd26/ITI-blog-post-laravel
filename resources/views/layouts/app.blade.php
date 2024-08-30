<!doctype html>
<html class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="{{asset('theme-toggle.js')}}"></script>
    <title>@yield('title')</title>
</head>

<body class="min-h-dvh dark:bg-zinc-800">
    <nav class="bg-white shadow mb-9 border-zinc-200 dark:bg-zinc-900">
        <div class="container flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-4 rtl:space-x-reverse">
                <img src="https://iti.gov.eg/assets/images/ColoredLogo.svg" class="size-16" alt="ITI Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Laravel Lab</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-zinc-500 rounded-lg md:hidden hover:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-200 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:focus:ring-zinc-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-zinc-100 rounded-lg bg-zinc-50 md:flex-row md:items-center md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-zinc-800 md:dark:bg-zinc-900 dark:border-zinc-700">

                    @guest
                        @if(Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}"
                                    class="block py-2  px-3 text-zinc-900 rounded hover:bg-zinc-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                    {{__('Login')}}</a>
                            </li>
                        @endif
                        @if(Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}"
                                    class="block py-2  px-3 text-zinc-900 rounded hover:bg-zinc-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                    {{__('Register')}}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <!-- src="http://127.0.0.1:8000/images/posts/images/nUwjyoeeXYmEi6i76wlMwQXUj1IhbmVxgsT1BNAd.png" -->
                            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                                data-dropdown-placement="bottom" class="size-16 rounded-full cursor-pointer"
                                src="{{asset('images/users/' . (Auth::user()->image ? Auth::user()->image : 'images/default.png'))}}"
                                alt="User dropdown">
                            <div id="userDropdown"
                                class="z-10 hidden bg-white divide-y divide-zinc-100 rounded-lg shadow w-44 dark:bg-zinc-700 dark:divide-zinc-600">
                                <div class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                                    <div>{{Auth::user()->name}}</div>
                                    <div class="font-medium truncate">{{Auth::user()->email}}</div>
                                </div>
                                <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="avatarButton">
                                    <li>
                                        <a href="{{ route('posts.index') }}"
                                            class="block px-4 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">All
                                            posts</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('creators.index') }}"
                                            class="block px-4 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">All
                                            creators</a>
                                    </li>

                                    <li><button
                                            class="block w-full text-start px-4 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white"
                                            onclick="toggleDarkMode()">Change theme</button></li>

                                </ul>
                                <div class="py-1">
                                    <form action="{{ route('logout') }}" method="POST"
                                        class="block cursor-pointer px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:text-zinc-200 dark:hover:text-white">
                                        @csrf
                                        <button type="submit">
                                            Sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>

                    @endguest

                </ul>
            </div>
        </div>
    </nav>
    <div class="container mx-auto ">
        @yield("content")
    </div>
</body>

</html>