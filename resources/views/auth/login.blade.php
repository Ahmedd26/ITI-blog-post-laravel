@extends('layouts.app')
@section('title')
Login
@endsection

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
    <div class="flex items-center gap-4 mb-6 text-2xl font-semibold text-zinc-900 dark:text-white">
        <img src="https://iti.gov.eg/assets/images/ColoredLogo.svg" class="size-16" alt="ITI Logo" />
        <span>
            ITI Blogs
        </span>
    </div>
    <div
        class="w-full bg-white rounded-lg shadow-xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-zinc-900 dark:border-zinc-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-zinc-900 md:text-2xl dark:text-white">
                Sign in to your account
            </h1>
            <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Your
                        {{ __('Email Address') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="auth-input @error('email') auth-input-invalid @enderror" placeholder="name@company.com">
                    @error('email')
                        <span class="auth-alert mt-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="auth-input @error('email') auth-input-invalid @enderror">
                    @error('password')
                        <span class="auth-alert mt-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox"
                                class="w-4 h-4 border border-zinc-300 rounded bg-zinc-50 focus:ring-3 focus:ring-blue-300 dark:bg-zinc-700 dark:border-zinc-600 dark:focus:ring-blue-600 dark:ring-offset-zinc-800">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="text-zinc-500 dark:text-zinc-300">Remember me</label>
                        </div>
                    </div>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot
                        password?</a>
                </div>
                <div>
                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
                        in</button>
                </div>
                <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">
                    Don’t have an account yet? <a href={{route('register')}}
                        class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign up</a>
                </p>
            </form>
            <div class="relative">
                <hr class="dark:border-zinc-400">
                <span
                    class="dark:text-zinc-400 px-3 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 bg-white dark:bg-zinc-900 font-bold text-md">Or</span>
            </div>
            <div class="flex items-center justify-center">

                <a href="{{route("github.login")}}"
                    class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 me-2 mb-2">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                            clip-rule="evenodd" />
                    </svg>
                    Sign in with Github
                </a>
            </div>
        </div>
    </div>
</div>
@endsection