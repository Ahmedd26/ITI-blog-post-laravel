<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Creator;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{


    function __construct()
    {
        $this->middleware("auth")->only(["create"]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $creators = Creator::all();
        $posts = Post::paginate(3);
        // dd(compact("posts", "creators"));
        // return view("posts.index", compact("posts", "creators"));
        return view("posts.index", compact("posts"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->posts()->count() >= 3) {
            return redirect()->route('posts.index')->with('error', 'You can only create up to 3 posts.');
        }
        $creators = Creator::all();
        return view('posts.create', compact('creators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $user = Auth::user();
        if ($user->posts()->count() >= 3) {
            return redirect()->route('posts.index')->with('error', 'You can only create up to 3 posts.');
        }
        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store("images", 'posts_images');
        }
        $request_data = request()->all();
        $request_data['image'] = $image_path;
        $request_data['creator_id'] = Auth::id();
        $post = Post::create($request_data);
        return to_route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $creator = Creator::find($post->creator_id);
        return view('posts.show', compact('post', 'creator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->creator_id != Auth::id()) {
            return to_route('posts.index')->with('error', 'Unauthorized action, you can only edit the posts you own');
        }

        $creators = Creator::all();
        return view("posts.edit", compact('post', 'creators'));
    }


    // public function update(Request $request, Post $post)
    // {
    //     $imagePath = $post->image;

    //     if ($request->hasFile('image')) {
    //         if ($imagePath) {
    //             Storage::disk('posts_images')->delete($imagePath);
    //         }
    //         $image = $request->file('image');
    //         $imagePath = $image->store("images", 'posts_images');
    //     }

    //     $requestData = $request->all();
    //     $requestData['image'] = $imagePath;
    //     $post->update($requestData);

    //     return to_route('posts.show', $post);
    // }
    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->creator_id != Auth::id()) {
            return to_route('posts.index')->with('error', 'Unauthorized action, you can only edit the posts you own');
        }
        $imagePath = $post->image;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('posts_images')->delete($imagePath);
            }
            $image = $request->file('image');
            $imagePath = $image->store("images", 'posts_images');
        }

        $requestData = $request->all();
        $requestData['image'] = $imagePath;
        $post->update($requestData);

        return to_route('posts.show', $post);
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Post $post)
    {
        // if ($post->creator_id != Auth::id()) {
        //     return to_route('posts.index')->with('error', 'Unauthorized action, you can only delete the posts you own');
        // }
        // if (!Gate::allows('delete-post', $post)) {
        //     // abort(403);
        //     return to_route('posts.index')->with('error', 'Unauthorized action, you can only delete the posts you own');
        // }
        if (!Auth::user()->can('delete-post', $post)) {
            // abort(403);
            return to_route('posts.index')->with('error', 'Unauthorized action, you can only delete the posts you own');
        }

        if ($post->image) {
            Storage::disk('posts_images')->delete($post->image);
        }
        $post->delete();
        return to_route('posts.index')->with('success', 'Post deleted successfully');
    }
}
