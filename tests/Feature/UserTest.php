<?php

namespace Tests\Feature;

use App\Models\post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login(){

        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');

    }

    public function test_signin(){

        $response = $this->get(route('signin'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.signin');

    }

    public function test_user_login()
    {
        $this->assertGuest();
        Auth::loginUsingId(1);
        $user = User::factory()->create();
        $response = $this->post(route('user_login'),[
            'email' => $user->email,
            'password' => $user->password,
        ]);
        $response->assertStatus(302)->assertRedirectContains(route('login'));
        $this->assertAuthenticated();
    }

    public function test_add_user(){

        $user = User::factory()->make();
        $response = $this->post(route('add_user'),[
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
            'name' => $user->name,
            'phone' => '0978942425',

        ]);
        //Assert that the session has no validation errors:
        $response->assertSessionHasNoErrors();

        $response->assertRedirectContains(route('login'));

    }

    public function test_add_user_validate_email_required(){
        $data = [
            'email' => '',
            'password' => '123456',
            'password_confirmation' => '123456',
            'name' => 'Hoàng Văn Lĩnh',
            'phone' => '0978942425',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['email'=>'Nhập email!']);

    }

    public function test_add_user_validate_email_email(){
        $data = [
            'email' => 'admin@gmail.com@',
            'password' => '123456',
            'password_confirmation' => '123456',
            'name' => 'Hoàng Văn Lĩnh',
            'phone' => '0978942425',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['email'=>'Nhập đúng định dạng email!']);

    }

    public function test_add_user_validate_name_required(){
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'name' => '',
            'phone' => '0978942425',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['name'=>'Nhập đầy đủ họ tên!']);

    }

    public function test_add_user_validate_name_min(){
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'name' => 'tung',
            'phone' => '0978942425',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['name'=>'Họ tên tối thiểu 5 kí tự!']);

    }

    public function test_add_user_validate_name_max(){
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'name' => 'Lê Hoàng Hiếu Nghĩa Đệ Nhất Thương Tâm Nhân Vua Lì Đòn Kẻ Hủy Diệt Những Cái Tên',
            'phone' => '0978942425',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['name'=>'Họ tên bạn không tồn tại!']);

    }

    public function test_add_user_validate_phone_required(){
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'name' => 'Lê Hoàng Hiếu Nghĩa Đệ Nhất Thương Tâm Nhân',
            'phone' => '',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['phone'=>'Nhập số điện thoại!']);

    }

    // public function test_add_user_validate_phone_regex(){
    //     $data = [
    //         'email' => 'admin@gmail.com',
    //         'password' => '123456',
    //         'password_confirmation' => '123456',
    //         'name' => 'Lê Hoàng Hiếu Nghĩa Đệ Nhất Thương Tâm Nhân',
    //         'phone' => '0006782347',

    //     ];
    //     $response = $this->post(route('add_user'),$data);
    //     $response->assertStatus(302)->assertSessionHasErrors(['phone'=>'Nhập đúng số điện thoại!']);

    // }

    public function test_add_user_validate_pasword_required(){
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '',
            'password_confirmation' => '123456',
            'name' => 'Lê Hoàng Hiếu Nghĩa Đệ Nhất Thương Tâm Nhân',
            'phone' => '0006782347',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['password'=>'Điền mật khẩu!']);

    }

    public function test_add_user_validate_pasword_confirmed(){
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'password_confirmation' => '',
            'name' => 'Lê Hoàng Hiếu Nghĩa Đệ Nhất Thương Tâm Nhân',
            'phone' => '0006782347',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['password'=>'Điền mật khẩu không khớp!']);

    }

    public function test_add_user_validate_pasword_min(){
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '12345',
            'password_confirmation' => '123456',
            'name' => 'Lê Hoàng Hiếu Nghĩa Đệ Nhất Thương Tâm Nhân',
            'phone' => '0006782347',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['password'=>'Mật khẩu tối thiểu 6 kí tự!']);

    }

    public function test_add_user_validate_pasword_max(){
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '123452342343243243243243243244444444444444444444444444444444444444444444444444444444444444',
            'password_confirmation' => '123456',
            'name' => 'Lê Hoàng Hiếu Nghĩa Đệ Nhất Thương Tâm Nhân',
            'phone' => '0006782347',

        ];
        $response = $this->post(route('add_user'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['password'=>'Mật khẩu tối đa 32 kí tự!']);

    }

    public function test_login_validate_email_required(){

        $data = [
            'email' => '',
            'password' => '123452342343243243243243243244444444444444444444444444444444444444444444444444444444444444',
        ];
        $response = $this->post(route('user_login'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['email'=>'Vui lòng nhập tài khoản email!']);

    }

    public function test_login_validate_email_regex(){

        $data = [
            'email' => 'admin@gmail.com@',
            'password' => '123452342343243243243243243244444444444444444444444444444444444444444444444444444444444444',
        ];
        $response = $this->post(route('user_login'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['email'=>'Vui lòng đúng định dạng email!']);

    }

    public function test_login_validate_password_required(){

        $data = [
            'email' => 'admin@gmail.com@',
            'password' => '',
        ];
        $response = $this->post(route('user_login'),$data);
        $response->assertStatus(302)->assertSessionHasErrors(['password'=>'Nhập mật khẩu!']);

    }


    public function test_logout(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('logout'));
        $response->assertRedirect(route('login')); 
        $this->assertGuest(); 

    }
}
