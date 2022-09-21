<?php

namespace App\Http\Controllers;

use App\Http\Entities\PostEntity;
use App\Http\Requests\PostRequest;
use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('post_view')) {
        //     abort(403);
        // }
        $categories = category::all();
        return view('admin.post.list_post', compact('categories'));
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
    public function store(PostRequest $dataPost)
    {
        if (!Gate::allows('post_add')) {
            abort(403);
        }
        $postEntity = new PostEntity;

        if ($postEntity->addPost($dataPost)) {
            return response()->json([
                'status'  => '200',
                'message' => 'Thêm mới bào viết thành công'
            ],200);
        }
        return response()->json([
            'status'  => '404',
            'message' => 'Thêm bài viết thất bại, Vui lòng thử lại!'
        ],404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (!Gate::allows('post_edit')) {
            abort(403);
        }
        $post = post::find($id);
        return response()->json([
            'post' => $post,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $dataPost, $id)
    {
        if (!Gate::allows('post_edit')) {
            abort(403);
        }

        if (!post::find($id)) {

            return response()->json([
                'status'  => '404',
                'message' => 'Update bài viết thất bại, Vui lòng thử lại!'
            ],404);
        }

        $postEntity = new PostEntity;
        $postEntity->update($dataPost, $id);
        return response()->json([
            'status'  => '200',
            'message' => 'Update bài viết thành công'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('post_delete')) {
            abort(403);
        }

        if (!post::find($id)) {
            return response()->json([
                'status'  => '404',
                'message' => 'Xóa thất bại, Vui lòng thử lại!'
            ],404);
        }

        $postEntity = new PostEntity;
        $postEntity->destroy($id);

        return response()->json([
            'status'  => '200',
            'message' => 'Xóa thành công bài viết'
        ],200);
    }
}
