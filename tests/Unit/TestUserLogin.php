<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TestUserLogin extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_login()
    {
        $user = User::factory()->create([
            'name' => 'Emma',
            'email' => 'emma@gmail.com',
            'password' => 'passemma'
        ]);

        $userData = [
            'email' => 'emma@gmail.com',
            'password' => 'passemma'
        ];

        $loggedIn = Auth::attempt($userData);

        $this->assertTrue($loggedIn);
        $this->assertEquals($user->id, Auth::id());
    }
}
