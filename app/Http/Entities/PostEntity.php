<?php

namespace App\Http\Entities;

use App\Models\post;
use Illuminate\Support\Facades\Auth;

class PostEntity
{
    public function getDataPost()
    {
        $posts = post::orderBy('created_at', 'DESC')
            ->with(['category', 'nameUser'])
            ->get()->map(function ($post) {
                $post->category_name = !is_null($post->category) ? $post->category->name : "";
                return $post;
            })->map(function ($user) {
                $user->user_name = !is_null($user->nameUser) ? $user->nameUser->name : "";
                return $user;
            });
        return response()->json([
            'data' => $posts,
        ]);
    }

    public function addPost($data)
    {
        if ($data->file('image')) {

            $image = $this->saveImage($data->file('image'), $data->title, 'baiviet');
        }
        $addPost = post::create([
            
            'title'       => $data->title,
            'id_user'     => Auth::user()->id,
            'id_category' => $data->id_category,
            'desc'        => $data->desc,
            'image'       => $image,
            'post_at'     => $data->post_at,
        ]);

        return $addPost;
    }

    public function saveImage($file, $title, $forder)
    {

        $imagePath = $file->getClientOriginalName();
        $imageName = $title . '_' . $imagePath;
        $file      = $file->storeAs($forder, $imageName);
        return $file;
    }

    public function update($data, $id)
    {
        
        if ($data->file('image')) {

            $image = $this->saveImage($data->file('image'), $data->title, 'baiviet');
        } else {

            $post  = post::find($id);
            $image = $post->image;
        }

        $updatePost = post::where('id', $id)
            ->update([

                'id_user'     => Auth::user()->id,
                'image'       => $image,
                'title'       => $data->title,
                'id_category' => $data->id_category,
                'desc'        => $data->desc,
                'post_at'     => $data->post_at,

            ]);

        return $updatePost;
    }

    public function destroy($id)
    {

        post::destroy($id);
    }
}
