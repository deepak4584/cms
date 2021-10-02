<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {

        return view('blog-post', ['post' => $post]);
    }

    public function create()
    {

        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'post_image' => 'required | mimes:jpg,png,jpeg',
            'body' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $name = $request->file('post_image')->getClientOriginalName();
        $request->post_image->move(public_path('images'), $name);

        // $test =  $request->poddst_image->move(public_path('images'));
        $emp = new Post;
        $emp->user_id = $user_id;
        $emp->title = $request->title;
        $emp->body = $request->body;
        $emp->post_image = $name;
        $emp->save($validatedData);
        back()->with('Created', 'Post Was Created');
        return redirect()->route('post.index');
    }


    public function edit(Post $post)
    {

        return view('admin.posts.edit', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->back()->with('message', 'Post Was Deleted');
        return  back();
    }
    public function update(Post $post, Request $request)
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'post_image' => 'required | mimes:jpg,png,jpeg',
            'body' => 'required',
        ]);
        if (request('post_image')) {
            $validatedData['post_image'] = request('post_image')->store('images');
        }
        $user_id = Auth::user()->id;
        $name = $request->file('post_image')->getClientOriginalName();
        $request->post_image->move(public_path('images'), $name);

        $emp = new Post;
        $emp->user_id = $user_id;
        $emp->title = $request->title;
        $emp->body = $request->body;
        $emp->post_image = $name;
        $emp->save($validatedData);
        back()->with('Updated', 'Post Was Updated');
        return redirect()->route('post.index');
    }
}