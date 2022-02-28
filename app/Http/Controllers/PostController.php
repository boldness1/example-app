<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
     
        return response()->json([
            'type' => 'user_posts_all',
            'posts' =>  $user->posts()->get()->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('content');

        $rules = [
            'content' => ['required', 'string', 'max:1000']
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validation',
                'errors' => $validator->errors()->all()

            ]);
        }

        $user = $request->user();

        try {

            $postCreated = $user->posts()->create($data);
        } catch (Exception $exception) {
            throw $exception;
        }

        return response()->json([
            'type' => 'user_post_create',
            'created_user' => $postCreated
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {
         $user = $request->user();
          
            return response()->json([
            'type' => 'user_post' ,
            'post' =>  $post ?? 'not_found'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post)
    {
        $data = $request->only('content');

        $rules = [
            'content' => ['required', 'string', 'max:1000']
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validation',
                'errors' => $validator->errors()->all()

            ]);
        }
      

        try {
             $postUpdated = $post->update($data);
        } catch (Exception $exception) {
            throw $exception;
        }

        return response()->json([
            'type' => 'user_posts_update',
            'updated' => $postUpdated
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->only('content');

        $rules = [
            'content' => ['required', 'string', 'max:1000']
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validation',
                'errors' => $validator->errors()->all()

            ]);
        }
      

        try {
             $postUpdated = $post->update($data);
        } catch (Exception $exception) {
            throw $exception;
        }

        return response()->json([
            'type' => 'user_posts_update',
            'updated' => $postUpdated
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
             $postDeleted = $post->delete();
        } catch (Exception $exception) {
            throw $exception;
        }

           return response()->json([
            'type' => 'user_posts_update',
            'deleted' => $postDeleted
        ]);
    }
}
