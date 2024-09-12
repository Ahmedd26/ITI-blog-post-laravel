<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\PostResource;

class PostController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $post_validator = Validator::make($request->all(), [
    //         "title" => [
    //             "required",
    //             "unique:posts",
    //             "min:3"
    //         ],
    //         "description" => "required|string|min:10",
    //         "image" => "image|mimes:jpeg,jpg,png|max:2048",
    //     ]);

    //     if ($post_validator->fails()) {
    //         return response()->json($post_validator->errors(), 422)
    //         ;
    //     }

    //     $image_path = null;
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $image_path = $image->store("images", 'posts_images');
    //     }
    //     $request_data = request()->all();
    //     $request_data['image'] = $image_path;
    //     $post = Post::create($request_data);
    //     return $post;
    // }
    public function store(StorePostRequest $request)
    {
        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store("images", 'posts_images');
        }
        $request_data = request()->all();
        $request_data['creator_id'] = Auth::id();
        $request_data['image'] = $image_path;
        $post = Post::create($request_data);
        // return $post;
        return new PostResource($post);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // return $post;
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // $post_validator = Validator::make($request->all(), [
        //     "title" => [
        //         "required",
        //         "min:3",
        //         Rule::unique("posts", 'title')->ignore($post)
        //     ],
        //     "description" => "required|string|min:10",
        //     "image" => "nullable|image|mimes:jpeg,jpg,png|max:2048",
        // ]);

        // if ($post_validator->fails()) {
        //     return response()->json($post_validator->errors(), 422)
        //     ;
        // }

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
        // return $post;
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        if ($post->image) {
            Storage::disk('posts_images')->delete($post->image);
        }
        $post->delete();
        $response = response()->json(["Output" => "Deleted"], 200);
        return $response;
    }
}
