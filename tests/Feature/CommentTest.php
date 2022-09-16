<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_comment()
    {
        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('admin.comments'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.comment.comment');
    }

    public function test_delete_comment(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->delete(route('admin.delete_comment',1));

        $response->assertStatus(200);

        $response->assertOk()->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'status',
            'message',
        ]));
    }

    public function test_comment_data(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('admin.comment_data'));

        $response->assertStatus(200);
        $response->assertOk()->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'data',
        ]));
    }

    public function test_comment_show(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('admin.comment',1));

        $response->assertStatus(200);
        $response->assertOk()->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'data',
        ]));
    }

    public function test_view_comment(){
        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('admin.comments'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.comment.comment');
    }

    public function test_add_comment_validate_comment_required(){
        
        Auth::loginUsingId(1);
        $this->assertAuthenticated();

        $data = [
            'post_id' => '1',
            'comment' => '',
        ];
        $response = $this->post(route('comment'),$data);

        $response->assertStatus(302)->assertSessionHasErrors(['comment'=>'Nhập comment!']);

    }

    public function test_add_comment_validate_comment_min(){
        
        Auth::loginUsingId(1);
        $this->assertAuthenticated();

        $data = [
            'post_id' => '1',
            'comment' => 'a',
        ];
        $response = $this->post(route('comment'),$data);

        $response->assertStatus(302)->assertSessionHasErrors(['comment'=>'Tên comment tốt thiểu 2 kí tự!']);

    }

    public function test_add_comment_validate_comment_max(){
        
        Auth::loginUsingId(1);
        $this->assertAuthenticated();

        $data = [
            'post_id' => '1',
            'comment' => 'The PSR-7 standard specifies interfaces for HTTP messages, including requests and responses. If you would like to obtain an instance of a PSR-7 request instead of a Laravel request, you will first need to install a few libraries. Laravel uses the Symfony HTTP Message Bridge component to convert typical Laravel requests and responses into PSR-7 compatible implemen',
        ];
        $response = $this->post(route('comment'),$data);

        $response->assertStatus(302)->assertSessionHasErrors(['comment'=>'Tên comment tối đa 255 kí tự!']);

    }

}
