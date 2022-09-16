<?php

namespace App\Http\Controllers;

use App\Http\Entities\CategoryEntity;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Gate::allows('category_view')){

            abort(403);
        }
        return view('admin.category.category', [
            'id_levels' => category::all(),
            'categories' => category::paginate(5),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( )
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if(! Gate::allows('category_add')){
            abort(403);
        }
        $categoryEntity = new CategoryEntity();

        $categoryEntity->store($request);

        return redirect()->route('admin.category')->with('alert_success', 'Thêm chuyên mục mới thành công');
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
       
        if(! Gate::allows('category_edit')){
            abort(403);
        }

        $category = category::find($id);
        $id_levels = category::all();
        $categories =category::paginate(5);
       
        return view('admin.category.category', [
            'category' => $category,
            'id_levels' => $id_levels,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if(! Gate::allows('category_edit')){
            abort(403);
        }
        $categoryEntity = new CategoryEntity();

        $categoryEntity->update($request,$id);

        return redirect()->route('admin.category')->with('alert_success','Thay đổi thành công chuyên mục');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if(! Gate::allows('category_delete')){
            abort(403);
        }
        if($id){
            category::destroy($id);
            // category::whereIn('id_level', $id_ct)->get()->delete(); 
            return redirect()->route('admin.category')->with('alert_success', 'Xóa thành công chuyên mục');
        }
       
    }
}
