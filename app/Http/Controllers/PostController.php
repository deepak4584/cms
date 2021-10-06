<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Auth;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->where('user_id', '=', Auth::user()->id)->get();
        // $posts = Post::all();
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
        $this->authorize('create', Post::class);

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
        back()->with('Created', 'Post Has been Created');
        return redirect()->route('post.index');
    }


    public function edit(Post $post)
    {
        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->back()->with('message', 'Post Has been Deleted');
        return  back();
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'post_image' => 'required | mimes:jpg,png,jpeg',
            'body' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('post_image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['post_image'] = "$profileImage";
        } else {
            unset($input['post_image']);
        }

        $post->update($input);

        back()->with('Updated', 'Post Has been Updated');
        return redirect()->route('post.index');
    }
}