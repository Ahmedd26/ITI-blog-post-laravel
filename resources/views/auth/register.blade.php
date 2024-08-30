@extends('layouts.app')
@section('title')
Register
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
                Create new account
            </h1>
            <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}"
                enctype="multipart/form-data" novalidate>
                @csrf
                <!-- Name -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Your
                        {{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="auth-input @error('name') auth-input-invalid @enderror" placeholder="John Doe">
                    @error('name')
                        <span class="auth-alert mt-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Email -->
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
                <!-- Image -->
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Your
                        {{ __('Profile Picture') }}</label>
                    <input
                        class="block w-full text-sm text-zinc-900 border border-zinc-300 rounded-lg cursor-pointer bg-zinc-50 dark:text-zinc-400 focus:outline-none dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400"
                        aria-describedby="image_upload_help" id="image" type="file" name="image"
                        value="{{ old('image') }}">

                    @error('image')
                        <span class="auth-alert mt-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Password -->
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
                <!-- Confirm Password -->
                <div>
                    <label for="password-confirm"
                        class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" id="password-confirm" placeholder="••••••••"
                        class="auth-input @error('password-confirm') auth-input-invalid @enderror">
                    @error('password_confirmation')
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
                    Don’t have an account yet? <a href="#"
                        class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign up</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection