<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    private $userDB = [
        'email' => 'hamada.undetected@gmail.com',
    ];
    private $adminDB = [
        'email' => 'hamada.admin@gmail.com',
    ];

    public function test_get_product()
    {
        $user = User::whereEmail($this->userDB['email'])->first();
        $response = $this->actingAs($user)->get('/api/product');

        $response->assertStatus(200);
    }

    public function test_get_product_admin()
    {
        $admin = User::whereEmail($this->adminDB['email'])->first();
        $response = $this->actingAs($admin)->get('/api/admin/product?department=games&product=Chips&sort=price_asc');

        $response->assertStatus(200);
    }

    public function test_get_my_product()
    {
        $user = User::whereEmail($this->userDB['email'])->first();
        $response = $this->actingAs($user)->get('/api/product/my-product');

        $response->assertStatus(200);
    }
}
