<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('posts.create')->with('users', $users);;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 

            $validate = Validator::make($request->all(), [
                'title' => 'required|unique:posts|min:5|max:15',
                'description' => 'required',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $input = $request->all();
            $post = new Post;
            $image = $request->file('image');
            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move('uploads/imags/', $imagename);
                $post->image = $imagename;
            }
           $post->create($input);
   

            return redirect()->route('posts.index')->with('flash_message', 'Post Addedd !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = Post::find($id);
        return view('posts.show')->with('post', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts = Post::find($id)->first();
        return view('posts.edit', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:5|max:15',
            'description' => 'required',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }


        $post = Post::find($id);
        $input = $request->all();
        $image = $request->file('image');
            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move('uploads/imags/', $imagename);
                $post->image = $imagename;
            }
        $post->update($input);
        return redirect()->route('posts.index')->with('flash_message', 'Post Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return redirect()->back();
    }
}
