<?php

namespace App\Http\Entities;

use App\Models\User;
use App\Models\User_role;

class UserRoleEntity
{
    public function updateRoleUser($data, $id){

        if($data->dataUser['name'] == null || $data->dataUser['email'] == null || $data->dataUser['phone'] == null){
            
            return response()->json([
                'status'  => '404',
                'message' => 'Không được để trống!'
            ]);
        }

        if ($data->role_id == null) {

            return response()->json([
                'status'  => '404',
                'message' => 'Vui lòng chọn vai trò!'
            ]);
        }
        if($data->dataUser['avt'] == null){

            $user = User::find($id);
            $avatar = $user->avatar;
        }
        
        $avatar = $data->dataUser['avatar'];

        User::where('id', $id)
            ->update([

                'name'   => $data->dataUser['name'],
                'email'  => $data->dataUser['email'],
                'phone'  => $data->dataUser['phone'],
                'avatar' => $avatar,

            ]);

        User_role::where('user_id', $id)->delete();

        foreach ($data->role_id as $role_ids) {

            User_role::create([
                'role_id' => $role_ids,
                'user_id' => $id,
            ]);
        }
    }
}
