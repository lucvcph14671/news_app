<?php

namespace App\Http\Controllers;

use App\Http\Entities\UserRoleEntity;
use App\Models\User;
use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::whereNot('email', 'admin@gmail.com')->get();
        $roles = DB::table('roles')->select('id', 'name', 'desc_name')->get();
        return view('admin/user/user_list', compact('users', 'roles'));
    }

    public function formEditUser(Request $request, $id){
        $roles = DB::table('roles')->select('id', 'name', 'desc_name')->get();
        return view('admin/user/form-edit', compact('roles'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRole($id, Request $request)
    {
        $userRoleEntity = new UserRoleEntity;
        $userRoleEntity->updateRoleUser($request, $id);
        return response()->json([
            'status' => '200',
            'message' => 'Update trạng thái tài khoản thành công'
        ],200);

        // return response()->json([
        //     'status' => '404',
        //     'message' => 'Update trạng thái tài khoản thất bại, Vui lòng thử lại!'
        // ]);

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
