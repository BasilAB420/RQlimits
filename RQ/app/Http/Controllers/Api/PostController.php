<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();

        $res = [
            'data' => $posts,
            'message' => 'Yeah',
            'status' => 200
        ];

        return response($res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $res = [
                'data' => null,
                'message' => $validator->errors(),
                'status' => 400
            ];
        }

        $post = Post::create($request->all());

        $post = [
            'data' => $post,
            'message' => 'Post has been added',
            'status' => 201
        ];

        return response($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if ($post) {
            $res = [
                'data' => $post,
                'message' => 'Post has been found',
                'status' => 200
            ];
        } else {
            $res = [
                'data' => null,
                'message' => 'Post has not been found',
                'status' => 401
            ];
        }



        return response($res);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $res = [
                'data' => null,
                'message' => $validator->errors(),
                'status' => 400
            ];
        }

        $post = Post::find($id);

        if (!$post) {
            return $res = [
                'data' => null,
                'message' => 'Post dose not found',
                'status' => 404
            ];
        }

        $post->update($request->all());

        if ($post) {
            $post = [
                'data' => $post,
                'message' => 'Post Updated Successfully',
                'status' => 200
            ];
        } else {
            $post = [
                'data' => $post,
                'message' => 'Somthing went wrong !',
                'status' => 400
            ];
        }

        return response($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return $post = [
                'data' => null,
                'message' => 'Post dose not found',
                'status' => 404
            ];
        } else {
            $post->delete($id);

            return $post = [
                'data' => null,
                'message' => 'Post Deeleted successfully',
                'status' => 200
            ];
        }

        return response($post);
    }
}
