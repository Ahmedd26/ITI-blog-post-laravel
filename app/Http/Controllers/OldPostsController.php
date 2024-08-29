<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class OldPostsController extends Controller
{
    function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(3);
        return view("posts.index", ["posts" => $posts]);
    }


    function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return view("posts.show", ["post" => $post]);
        }
        abort(404);
    }

    function create()
    {
        return view("posts.create");
    }

    function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return to_route("posts.index");
        }
        abort(404);
    }
    function store()
    {
        $valid_data = request()->validate([
            "title" => "required|string",
            "description" => "required|string",
            "posted_by" => "required|string",
        ]);

        $request_data = request()->all();
        $post = new Post();
        $post->title = $request_data['title'];
        $post->description = $request_data['description'];
        $post->posted_by = $request_data['posted_by'];
        $post->save();
        return to_route("posts.show", $post->id);
    }

    function edit($id)
    {
        $post = Post::find($id);
        if ($post) {
            return view("posts.edit", ["post" => $post]);
        }
        abort(404);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'posted_by' => 'required|string',
        ]);

        $post = Post::find($id);
        if ($post) {
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->posted_by = $request->input('posted_by');
            $post->save();

            return to_route('posts.show', $post->id);
        }

        abort(404);
    }

}
