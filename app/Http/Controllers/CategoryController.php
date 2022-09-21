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
        if (!Gate::allows('category_view')) {

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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $dataCategory)
    {
        if (!Gate::allows('category_add')) {
            abort(403);
        }
        $categoryEntity = new CategoryEntity();

        $categoryEntity->store($dataCategory);

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

        if (!Gate::allows('category_edit')) {
            abort(403);
        }

        $category   = category::find($id);
        $id_levels  = category::all();
        $categories = category::paginate(5);

        return view('admin.category.category', [
            'category'   => $category,
            'id_levels'  => $id_levels,
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
    public function update(CategoryRequest $dataCategory, $id)
    {
        if (!Gate::allows('category_edit')) {
            abort(403);
        }
        if (!category::find($id)) {

            return redirect()->route('admin.category')->with('alert_success', 'Thay đổi Thất bại vui lòng kt lại!');
        }

        $categoryEntity = new CategoryEntity();

        $categoryEntity->updateCategoty($dataCategory, $id);

        return redirect()->route('admin.category')->with('alert_success', 'Thay đổi thành công chuyên mục');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('category_delete')) {
            abort(403);
        }

        if (!category::find($id)) {

            return redirect()->route('admin.category')->with('alert_success', 'Xóa Thất bại vui lòng kt lại!');
        }

        $categoryEntity = new CategoryEntity();
        $categoryEntity->destroyCategory($id);

        return redirect()->route('admin.category')->with('alert_success', 'Xóa thành công chuyên mục');
    }
}
