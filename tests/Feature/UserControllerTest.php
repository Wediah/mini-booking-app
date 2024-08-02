<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_registration()
    {
        $userData = [
            'name' => 'John Ofori',
            'email' => 'ofori@gmail.com',
            'password' => 'passofori1'
        ];

        $response = $this->postJson('api/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'user' => [
                    'id', 'name', 'email', 'created_at', 'updated_at'
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email']
        ]);

        $user = User::where('email',$userData['email'])->first();
        $this->assertTrue(Hash::check($userData['password'], $user->password));


    }

    public function test_user_login()
    {
        $user = User::factory()->create([
            'name' => 'John Ofori',
            'email' => 'ofori@gmail.com',
            'password' => Hash::make('passofori1'),
        ]);

        $userData = [
            'email' => 'ofori@gmail.com',
            'password' => 'passofori1'
        ];

        $response = $this->postJson('/api/login',$userData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id', 'name', 'email', 'created_at', 'updated_at'
                ],
                'token'
            ]);

        $this->assertArrayHasKey('token',$response->json());
    }
}
