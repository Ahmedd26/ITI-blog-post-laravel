@extends('layouts.app')
@section('title')
Post - {{ $post['id'] }}
@endsection

@section('content')
<div
    class="mx-2 sm:mx-0 rounded-lg overflow-hidden bg-zinc-50 dark:bg-zinc-700 dark:text-white border border-zinc-300 dark:border-zinc-500">
    <h1 class="text-2xl text-zinc-700 dark:text-white p-4 border-b border-zinc-300 dark:border-zinc-500"><span
            class="font-bold">Title: </span> <span class="uppercase">
            {{$post['title']}}</span></h1>
    <div class="flex">
        <div class="dark:bg-zinc-800 p-4">
            @if (Str::startsWith($post->image, 'http'))
                <img src="{{ $post->image }}" class="size-48">
            @else
                <img src="{{ asset("images/posts/$post->image") }}" class="size-48">
            @endif
        </div>
        <div class="flex-1 p-4 bg-white dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 space-y-2">
            <h4 class="text-xl font-bold">Description</h4>
            <p class="text-lg">{{$post['description']}}</p>
            @if ($creator)
                <span class="font-bold">By: {{$creator->name}}</span>
            @endif
        </div>
    </div>
</div>
@endsection