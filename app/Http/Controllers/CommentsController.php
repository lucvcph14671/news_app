<?php

namespace App\Http\Controllers;

use App\Http\Entities\CommentEntity;
use App\Http\Requests\CommentsRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.comment.comment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentsRequest $data)
    {
        $commentEntity = new CommentEntity;

        if (Auth::check()) {

            if ($commentEntity->store($data)) {
                return response()->json([
                    'status' => '200',
                    'message' => 'Nhận xét thành công'
                ]);
            }
            return response()->json([
                'status' => '404',
                'message' => 'Nhận xét thất bại, Vui lòng thử lại!'
            ]);
        }
        return response()->json([
            'status' => '400',
            'message' => 'Vui lòng bạn đăng nhập!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Comment::destroy($id)) {

            return response()->json([
                'status' => '200',
                'message' => 'Xóa nhận xét của bạn thành công'
            ]);
        } else {

            return response()->json([
                'status' => '404',
                'message' => 'Xóa thất bại, Vui lòng thử lại!'
            ]);
        }
    }
}
