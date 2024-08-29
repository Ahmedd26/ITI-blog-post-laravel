@extends('layouts.app')
@section('title')
Create Creator
@endsection

@section('content')

<form action="{{route("creators.store")}}" method="post" enctype="multipart/form-data">
    <div class="grid gap-6 mb-6 max-w-xl mx-auto">
        @csrf
        <!--** Creator Name **-->
        <div class="">
            <label for="name" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Creator Name</label>
            <input type="text" id="name"
                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Your creator name goes here" name="name" />
        </div>

        <!--** Submit **-->
        <div class="">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
</form>
<!-- ** Errors ** -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <div class="flex items-center p-4 mb-4 text-md text-red-800 rounded-lg bg-red-50 dark:bg-zinc-900 dark:text-red-500 border dark:border-red-500"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Invalid input!</span> {{ $error }}.
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
@endif

@endsection