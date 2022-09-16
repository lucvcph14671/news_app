<?php

namespace App\Http\Entities;

use App\Models\post;
use Illuminate\Support\Facades\Auth;

class PostEntity
{
    public function index()
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
                // dd($posts);
        return response()->json([   
            'data' => $posts,
        ]);
    }

    public function store($request)
    {
        $post = new post();

        if ($request->file('image')) {
            // Cách 1
            $imagePath = $request->file('image')->getClientOriginalName();
            $imageName = $request->title . '_' . $imagePath;
            $file = $request->file('image')->storeAs('baiviet', $imageName);
            //Cách 2
            // $imagePath = $request->file('image')->getClientOriginalName();
            // $imageName = $request->title . '_' . $imagePath;
            // $request->file('image')->storeAs('baiviet', $imageName);
            // $post->image = $request->oldImage;

            // return post::create([
            //     'title' => $request->title,
            //     'id_user' => Auth::user()->id,
            //     'id_category' => $request->id_category,
            //     'desc' => $request->desc,
            //     'image' => $file,
            //     'post_at' => $request->post_at
            // ]);

            $post->title = $request->title;
            $post->id_user = Auth::user()->id;
            $post->id_category = $request->id_category;
            $post->desc = $request->desc;
            $post->image = $file;
            $post->post_at = $request->post_at;
    
            return $post->save();
        }

       
    }

    public function update($request, $id)
    {
        // dd($request->id_user);
        $post = post::find($id);

        // $post->id_user = $id;
        $post->id_user = Auth::user()->id;

        if ($request->file('image')) {
            //cách 1
            // $imagePath = $request->file('image')->getClientOriginalName();
            // $imageName = $request->title . '_' . $imagePath;
            // $request->file('image')->storeAs('baiviet', $imageName);
            // $post->image = $request->oldImage;

            //Cách 2
            $imagePath = $request->file('image')->getClientOriginalName();
            $imageName = $request->title . '_' . $imagePath;
            $file = $request->file('image')->storeAs('baiviet', $imageName);
            $post->image = $file;
        } else {

            $post->image = $post->image;
        }

        $post->title = $request->title;
        $post->id_category = $request->id_category;
        $post->desc = $request->desc;
        $post->post_at = $request->post_at;

        return $post->save();
    }
}
