<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    private $testUser = [
        'name' => 'Hamada Tester',
        'email' => 'hamada.tester@gmail.com',
        'nik' => '1234567890000000',
        'password' => 'HamadaTester123',
        'access_token' => '',
        'role' => ''
    ];

    public function test_register()
    {
        $response = $this->post('/api/register', $this->testUser);

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $response = $this->post('/api/login', [
            'email'    => '',
            'nik'      => $this->testUser['nik'],
            'password' => $this->testUser['password'],
        ]);

        $this->testUser['access_token'] = $response->json()['access_token'];
        $this->testUser['role'] = $response->json()['user']['role'];

        $response->assertStatus(200);
    }

    public function test_login_fail()
    {
        $response = $this->post('/api/login', [
            'email'    => '',
            'nik'      => $this->testUser['nik'],
            'password' => '',
        ]);
        $response->assertStatus(422);
    }
    
    public function test_me()
    {
        $user = User::whereEmail($this->testUser['email'])->first();
        $response = $this->actingAs($user)
        ->get('/api/user/me');

        $response->assertStatus(200);
    }

    public function test_generate_password()
    {
        $response = $this->get('/api/user/generate-password?nik='.$this->testUser['nik'].'&role=user');

        $response->assertStatus(200);
    }

    public function test_destroy_user()
    {
        $user = User::whereEmail($this->testUser['email'])->first();
        $response = $this->actingAs($user)
        ->delete('/api/user/'.$user->id);

        $response->assertStatus(200);
    }
}
