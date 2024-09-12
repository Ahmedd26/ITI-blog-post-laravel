@extends('layouts.app')

@section('title', 'All Posts')

@section('content')

@if(session('success'))
    <div class="absolute top-[105px] left-1/2 -translate-x-1/2  flex justify-center">
        <div id="toast-success"
            class="transition-opacity duration-300 ease-in-out flex items-center w-full max-w-xs p-4 mb-4 text-zinc-500 bg-white rounded-lg shadow dark:text-zinc-400 dark:bg-zinc-900"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-zinc-400 hover:text-zinc-900 rounded-lg focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex items-center justify-center h-8 w-8 dark:text-zinc-500 dark:hover:text-white dark:bg-zinc-900 dark:hover:bg-zinc-800"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="absolute top-[105px] left-1/2 -translate-x-1/2 flex justify-center">

        <div id="toast-danger"
            class=" transition-opacity duration-300 ease-in-out flex items-center w-full max-w-xs p-4 mb-4 text-zinc-500 bg-white rounded-lg shadow dark:text-zinc-400 dark:bg-zinc-900"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('error') }}.</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-zinc-400 hover:text-zinc-900 rounded-lg focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex items-center justify-center h-8 w-8 dark:text-zinc-500 dark:hover:text-white dark:bg-zinc-900 dark:hover:bg-zinc-800"
                data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div>
@endif

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl dark:text-zinc-100 text-zinc-700">Recent Posts</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create post</a>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
            <tr>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Image</th>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Posted by</th>
                <th scope="col" class="px-6 py-3">Created at</th>
                <th scope="col" class="px-6 py-3">
                    @auth
                        Actions
                    @else
                        View
                    @endauth
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr
                    class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                    <th scope="row" class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">
                        {{ $post->id }}
                    </th>
                    <td class="px-6 py-4">
                        @if (Str::startsWith($post->image, 'http'))
                            <img src="{{ $post->image }}" class="size-24 rounded-lg">
                        @else
                            <img src="{{ asset("images/posts/$post->image") }}" class="size-24 rounded-lg">
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $post->title }}</td>
                    <td class="px-6 py-4">{{ $post->user->name ?? "Unknown"}}</td>
                    <td class="px-6 py-4">{{ $post->created_at->format('Y/m/d') }}</td>
                    <td class="px-6 py-4 ">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-tertiary">View</a>
                            @auth
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                <button data-modal-target="{{ 'popup-modal' . $post->id }}"
                                    data-modal-toggle="{{ 'popup-modal' . $post->id }}" class="btn btn-danger" type="button">
                                    Delete
                                </button>
                            @endauth
                        </div>

                        <!-- Confirm Delete Modal -->
                        <div id="{{ 'popup-modal' . $post->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-zinc-700">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-zinc-400 bg-transparent hover:bg-zinc-200 hover:text-zinc-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-zinc-600 dark:hover:text-white"
                                        data-modal-hide="{{ 'popup-modal' . $post->id }}">
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
                                        <h3 class="mb-5 text-lg font-normal text-zinc-500 dark:text-zinc-400">
                                            Are you sure you want to delete this post?
                                        </h3>
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" data-modal-hide="{{ 'popup-modal' . $post->id }}"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                            </form>
                                            <button data-modal-hide="{{ 'popup-modal' . $post->id }}" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-zinc-900 focus:outline-none bg-white rounded-lg border border-zinc-200 hover:bg-zinc-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-zinc-100 dark:focus:ring-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 dark:border-zinc-600 dark:hover:text-white dark:hover:bg-zinc-700">
                                                No, cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $posts->links() }}
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const successToast = document.getElementById('toast-success');
        const errorToast = document.getElementById('toast-danger');

        if (successToast) {
            setTimeout(() => {
                successToast.classList.add('opacity-0');
                setTimeout(() => successToast.remove(), 300); // remove the element after transition
            }, 3000);
        }

        if (errorToast) {
            setTimeout(() => {
                errorToast.classList.add('opacity-0');
                setTimeout(() => errorToast.remove(), 300); // remove the element after transition
            }, 3000);
        }
    });

</script>
@endsection