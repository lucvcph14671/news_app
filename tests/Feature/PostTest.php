<?php

namespace Tests\Feature;

use App\Models\post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_data_post()
    {
        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('admin.data_post'));
        $response->assertOk();

        $response->assertJson(fn (AssertableJson $json) =>
        $json->has('data'));
    }

    public function test_index(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('admin.post'));
        $response->assertOk();
        $response->assertViewIs('admin.post.list_post');

    }

    public function test_store_post(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $post = post::factory()->make();

        $response = $this->post(route('admin.post_add'),[
            'title' => $post->title,
            'id_category' => $post->id_category,
            'desc' => $post->desc,
        ]);
       
        $response->assertSessionHasNoErrors();
        $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'status',
            'message',
        ]));

    }
    public function test_store_post_500(){

        $post = post::factory()->make();

        $response = $this->post(route('admin.post_add'),[
            'title' => $post->title,
            'id_category' => $post->id_category,
            'desc' => $post->desc,
        ]);
       
        $response->assertStatus(500)->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'status',
            'message',
        ]));

    }
    public function test_store_post_validate_desc(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $invalidData = [
            'title' => 'Kiểm tra nội dung',
            'id_category' => '1',
            'desc' => '',
        ];

         $response = $this->post(route('admin.post_add'), $invalidData);

         $response->assertSessionHasErrors(['desc'=>'Viết nội dung!']);
        
    }

    public function test_store_post_validate_title(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $invalidData = [
            'title' => '',
            'id_category' => '1',
            'desc' => 'Hai con voi',
        ];

         $response = $this->post(route('admin.post_add'), $invalidData);

         $response->assertStatus(302)->assertSessionHasErrors(['title'=>'Chưa nhập tiêu đề!']);
        
    }

    public function test_store_post_validate_id_category(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $invalidData = [
            'title' => 'Ba con heo',
            'id_category' => '',
            'desc' => 'Hai con voi',
        ];

         $response = $this->post(route('admin.post_add'), $invalidData);
        $response->assertStatus(302)->assertSessionHasErrors(['id_category'=>'Vui lòng chọn danh mục!']);
        
    }

    public function test_store_post_validate_title_max(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $invalidData = [
            'title' => 'So, what if the incoming request fields do not pass the given validation rules? As mentioned previously, Laravel will automatically redirect the user back to their previous location. In addition, all of the validation errors and request input will automatically be flashed to the session.',
            'id_category' => '1',
            'desc' => 'Hai con voi',
        ];

         $response = $this->post(route('admin.post_add'), $invalidData);
        $response->assertStatus(302)->assertSessionHasErrors(['title'=>'Tiêu đề ít hơn 255 kí tự!']);
        
    }

    public function test_store_post_validate_title_min(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $invalidData = [
            'title' => 'ok',
            'id_category' => '1',
            'desc' => 'Hai con voi',
        ];

         $response = $this->post(route('admin.post_add'), $invalidData);
        $response->assertStatus(302)->assertSessionHasErrors(['title'=>'Tiêu đề tối thiểu 10 kí tự!']);
        
    }
    public function test_store_post_validate_category_id_num(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $invalidData = [
            'title' => 'okdfghdfhgfdhgfhgfhfghfg rsdgf',
            'id_category' => '-10',
            'desc' => 'Hai con voi',
        ];

        $response = $this->post(route('admin.post_add'), $invalidData);
        $response->assertStatus(302)->assertSessionHasErrors(['id_category'=>'The id category must be at least 1.']);
        
    }

    public function test_store_post_validate_category_id_min(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $invalidData = [
            'title' => 'okdfghdfhgfdhgfhgfhfghfg rsdgf',
            'id_category' => '-1',
            'desc' => 'Hai con voi',
        ];

         $response = $this->post(route('admin.post_add'), $invalidData);
        $response->assertStatus(302)->assertSessionHasErrors(['id_category'=>'The id category must be at least 1.']);
        
    }


    public function test_edit(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();

        $response = $this->get(route('admin.edit_post',1));
        $response->assertSessionHasNoErrors();

        $response->assertOk()->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'post',
        ]));
    }

    // public function test_update(){

    //     Auth::loginUsingId(1);
    //     $this->assertAuthenticated();

    //     $post = post::factory()->make();
    //     // dd($post);
    //     $response = $this->put(route('admin.update_post',4),[
    //         'title' => $post->title,
    //         'id_category' => $post->id_category,
    //         'desc' => $post->desc,
    //     ]);
        
    //     $response->assertSessionHasNoErrors();

    //     $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
    //     $json->hasAny([
    //         'status',
    //         'message',
    //     ]));
    // }

    public function test_destroy(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();

        $response = $this->delete(route('admin.delete_post',1));

        $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'status',
            'message',
        ]));
    }
}
