<?php

namespace App\Http\Entities;

use App\Models\User;
use App\Models\User_role;

class UserRoleEntity
{
    public function updateRoleUser($request, $id){

        if($request->dataUser['name'] == null || $request->dataUser['email'] == null || $request->dataUser['phone'] == null){
            return response()->json([
                'status' => '404',
                'message' => 'Không được để trống!'
            ]);
        }
       
            $user = User::find($id);
            $user->name = $request->dataUser['name'];
            $user->email = $request->dataUser['email'];
            $user->phone = $request->dataUser['phone'];
            if($request->dataUser['avt'] != null){
                $user->avatar = $request->dataUser['avatar'];
            }
            $user->save();
            
        if ($request->role_id == null) {
            return response()->json([
                'status' => '404',
                'message' => 'Vui lòng chọn vai trò!'
            ]);
        }
        User_role::where('user_id', $id)->delete();
        foreach ($request->role_id as $role_ids) {
            User_role::create([
                'role_id' => $role_ids,
                'user_id' => $id,
            ]);
        }
    }
}
