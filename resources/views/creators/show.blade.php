@extends('layouts.app')
@section('title')
Creator - {{ $creator['id'] }}
@endsection

@section('content')
<div
    class="mx-2 sm:mx-0 rounded-lg overflow-hidden bg-zinc-50 dark:bg-zinc-700 dark:text-white border border-zinc-300 dark:border-zinc-500">
    <h1 class="text-2xl text-zinc-700 dark:text-white p-4 border-b border-zinc-300 dark:border-zinc-500"><span
            class="font-bold">Creator Name: </span> <span class="uppercase">
            {{$creator['name']}}</span></h1>

    <!-- Here shall go the associated posts -->
    <div class="p-4 bg-white dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 space-y-2">
        <h4 class="text-xl font-bold"></h4>
        <p class="text-lg"></p>
    </div>
</div>
@endsection