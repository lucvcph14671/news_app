<?php

namespace App\Http\Entities;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class CommentEntity
{
    public function getDataComment()
    {
        return response()->json([
            'data' => Comment::orderBy('created_at', 'DESC')->get()
                ->map(function ($user) {
                    $user->user_name = !is_null($user->nameUser) ? $user->nameUser->name : "";
                    return $user;
                })->map(function ($post) {
                    $post->post_title = !isNull($post->titlePost) ? $post->titlePost->title : "";
                    return $post;
                })
        ],200);
    }
    public function showComment($id)
    {

        return response()->json([
            'data' => Comment::where('post_id', $id)->orderBy('created_at', 'DESC')->get()
                ->map(function ($user) {
                    $user->user_name = !is_null($user->nameUser) ? $user->nameUser->name : "";
                    return $user;
                })->map(function ($post) {
                    $post->post_title = !isNull($post->titlePost) ? $post->titlePost->title : "";
                    return $post;
                })
        ],200);
    }

    public function store($data)
    {
        return Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $data->id,
            'comment' =>  $data->comment
        ]);
    }
}
