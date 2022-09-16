<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Comment;
use App\Models\post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        
        $comments = Comment::all();
        $categories = category::all();
        $posts =  post::orderBy('created_at','DESC')->paginate(10);
        $posts_4 = post::orderBy('created_at','DESC')->paginate(4);

        return view('client.index.index', compact([ 'categories', 'posts', 'posts_4','comments']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailNew($id)
    {
        $detailPost = post::find($id);
        $categories = category::all();
        $countComment = Comment::where('post_id', $id)->get();
        $posts =  post::orderBy('created_at','DESC')->paginate(10);
        $posts_4 = post::orderBy('created_at','DESC')->paginate(4);
        return view('client.index.detail_new', compact([ 'categories', 'posts', 'posts_4', 'detailPost','countComment']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
