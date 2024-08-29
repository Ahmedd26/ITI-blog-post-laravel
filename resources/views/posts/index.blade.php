@extends('layouts.app')
@section('title')
All Posts
@endsection
@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl dark:text-zinc-100 text-zinc-700">Recent Posts</h1>
    <a href="{{route("posts.create")}}" class="btn btn-primary">Create post</a>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Posted by
                </th>
                <th scope="col" class="px-6 py-3">
                    Created at
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr
                    class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                    <th scope="row" class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">
                        {{$post->id}}
                    </th>
                    <td class="px-6 py-4">
                        @if (Str::startsWith($post->image, 'http'))
                            <img src="{{ $post->image }}" class="size-24 rounded-lg">
                        @else
                            <img src="{{ asset("images/posts/$post->image") }}" class="size-24 rounded-lg">
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{$post->title}}
                    </td>
                    <td class="px-6 py-4">
                        {{$post->creator->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$post->created_at->format('Y/m/d')}}
                    </td>
                    <td class="px-6 py-4 ">
                        <div class="flex items-center  gap-2">
                            <a href="{{route("posts.show", $post->id)}}" class="btn btn-tertiary">View</a>
                            <a href="{{route("posts.edit", $post->id)}}" class="btn btn-primary">Edit</a>
                            <button data-modal-target="{{'popup-modal' . $post->id}}"
                                data-modal-toggle="{{'popup-modal' . $post->id}}" class="btn btn-danger" type="button">
                                Delete
                            </button>
                        </div>
                        <!-- Confirm Delete Modal -->
                        <div id="{{'popup-modal' . $post->id}}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-zinc-700">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-zinc-400 bg-transparent hover:bg-zinc-200 hover:text-zinc-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-zinc-600 dark:hover:text-white"
                                        data-modal-hide="{{'popup-modal' . $post->id}}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-zinc-400 w-12 h-12 dark:text-zinc-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-zinc-500 dark:text-zinc-400">Are you sure
                                            you want to delete this post?</h3>
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{route("posts.destroy", $post->id)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button type="submit" data-modal-hide="{{'popup-modal' . $post->id}}"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                            </form>
                                            <button data-modal-hide="{{'popup-modal' . $post->id}}" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-zinc-900 focus:outline-none bg-white rounded-lg border border-zinc-200 hover:bg-zinc-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-zinc-100 dark:focus:ring-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 dark:border-zinc-600 dark:hover:text-white dark:hover:bg-zinc-700">No,
                                                cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </td>
                </tr>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4 ">
    {{ $posts->links() }}
</div>
@endsection