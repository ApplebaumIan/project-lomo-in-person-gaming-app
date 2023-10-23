<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister()
    {
        $userData = [
            "email" => "test@example.com",
            "password" => "password",
            "password_confirmation" => "password",
        ];

        $response = $this->json('POST', '/api/register', $userData);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     "data" => [
                         "email",
                         "updated_at",
                         "created_at",
                         "_id"
                     ]
                 ]);
    }

    public function testLogin()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $loginData = ['email' => 'test@example.com', 'password' => 'password'];

        $response = $this->json('POST', '/api/login', $loginData);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    "token",
                    "user" => [
                        "email",
                        "updated_at",
                        "created_at",
                        "_id"
                    ]
                ]);
    }
}
