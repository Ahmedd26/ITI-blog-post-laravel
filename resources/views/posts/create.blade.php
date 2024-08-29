@extends('layouts.app')
@section('title')
Create post
@endsection

@section('content')

<form action="{{route("posts.store")}}" method="post" enctype="multipart/form-data">
    <div class="grid gap-6 mb-6 max-w-xl mx-auto">
        @csrf
        <!--** Name **-->
        <div class="">
            <label for="title" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Title</label>
            <input type="text" id="title"
                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Your post title goes here" name="title" value="{{old('title')}}" />
        </div>
        <!--** Description **-->
        <div class="">
            <label for="message"
                class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Description</label>
            <textarea id="message" rows="4"
                class="block p-2.5 w-full text-sm text-zinc-900 bg-zinc-50 rounded-lg border border-zinc-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Write your thoughts here..." name="description"></textarea>
        </div>
        <!--** Image Upload **-->
        <div class="">
            <label class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white" for="image_upload">Upload
                image</label>
            <input
                class="block w-full text-sm text-zinc-900 border border-zinc-300 rounded-lg cursor-pointer bg-zinc-50 dark:text-zinc-400 focus:outline-none dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400"
                aria-describedby="image_upload_help" id="image_upload" type="file" name="image">
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-300" id="image_upload_help">SVG, PNG, JPG or GIF (MAX.
                800x400px).</p>
        </div>
        <!--** Creator **-->
        <div class="">
            <label for="creator" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Post
                creator</label>
            <select id="creator" name="creator_id"
                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option disabled selected value=""> Please choose creator</option>
                @foreach($creators as $creator)
                    <option value="{{$creator->id}}" {{old('creator_id') === $creator->id ? "selected" : ""}}>
                        {{$creator->name}}
                    </option>
                @endforeach
            </select>

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