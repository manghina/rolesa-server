<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only(['title', 'description', 'location']);
        $validator = Validator::make($data, [
            'title' => [
                'required',
                'string'
            ],
            'description' => [
                'required',
                'string'
            ],
            'location' => [
                'required',
                'string'
            ]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
                    ->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }        
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'],
            'author' => auth('api')->user()->id,
        ]);
        return response()->json($post, 200);
    }

    public function myPosts()
    {
        $posts = Post::where('author', auth('api')->user()->id)
                        ->where('parent_id', null)
                        ->with(['comments'])
                        ->select('id', 'title', 'description', 'location', 'created_at')
                        ->get();
        return response()->json([
            'data' => $posts
        ], 200);
    }

    public function all()
    {
        $posts = Post::where('parent_id', null)->with(['comments', 'user'])->get();
        return response()->json([
            'data' => $posts
        ], 200);
    }

    public function comment(Request $request, $id)
    {
        $data = $request->only(['description', 'parent_id']);
        $validator = Validator::make($data, [
            'description' => [
                'required',
                'string'
            ]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
                    ->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }
        $comment = Post::create([
            'description' => $data['description'],
            'parent_id' => $id,
            'author' => auth('api')->user()->id,
        ]);
        return response()->json($comment, 200);
    }

}