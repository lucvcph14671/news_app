<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\User_role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_role()
    {
        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('admin.show-form-edit-user',1));

        $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'data',
            'user',
        ]));
    }

    public function test_roles(){

        Auth::loginUsingId(1);
        $this->assertAuthenticated();
        $response = $this->get(route('admin.roles'));

        $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->hasAny([
            'data',
        ]));
    }

}
