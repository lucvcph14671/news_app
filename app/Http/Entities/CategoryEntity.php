<?php

namespace App\Http\Entities;

use App\Models\category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class CategoryEntity
{
    public function store($request){

        category::create([
            'name' => $request->name,
            'id_level' => $request->id_level,
            'status' => 0,
        ]);
    }

    public function update($request,$id){

        $category = category::find($id);
        $category->name = $request->name;
        $category->id_level = $request->id_level;
        $category->save();
    }
}
