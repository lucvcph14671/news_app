<?php

namespace App\Http\Entities;

use App\Models\category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class CategoryEntity
{
    public function store($data){

        category::create([

            'name'     => $data->name,
            'id_level' => $data->id_level,
            'status'   => 0,
        ]);
    }

    public function updateCategoty($data, $id){

        category::where('id', $id)
            ->update([

                'name'     => $data->name,
                'id_level' => $data->id_level,

            ]);
    }

    public function destroyCategory($id){

        category::destroy($id);

    }
}
