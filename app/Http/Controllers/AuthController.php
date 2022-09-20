<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SigninRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login', []);
    }

    public function user_login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {

            return redirect()->route('login')->with('msg_eror', 'Đăng nhập không thành công, vui lòng nhập tài khoản mật khẩu chính xác!');

        }

        if (Auth::user()->role == 2) {

            return redirect()->route('admin.post');
        }

        if (Auth::user()->role == 1) {

            return redirect()->route('admin.post');
        }

        return redirect()->route('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signin()
    {
        return view('auth.signin', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_user(SigninRequest $request)
    {
        //  dd($request->all());
        User::create([

            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'status'   => 0,
            'role'     => 0,
            'password' => Hash::make($request->password),
            
        ]);

        return redirect()->route('login')->with('msg', 'Đăng kí tài khoản thành công, vui lòng đăng nhập');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('msg', 'Bạn đã đăng xuất tài khoản thành công');
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
