<?php

namespace Tests\Feature;

use App\Livewire\Bookings;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Gate::define('admin', function (User $user) {
            return $user->name === 'Emma Wediah';
        });
    }

    public function test_to_fail_if_not_authenticated(): void
    {
        $response = $this->getJson('/api/all-bookings');

        $response->assertStatus(401);
    }

    public function test_to_fail_if_not_authorized(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/all-bookings');

        $response->assertStatus(403);
    }

    public function test_to_booking_added_non_admin():void
    {
        //creates user
        $user = User::factory()->create();

        //authenticated user
        Sanctum::actingAs($user);

        //defines data
        $bookingData = [
            'purpose' => 'Food meeting',
            'date' => now()->addDay()->toDateString()
        ];

        //sends post request to create booking
        $response = $this->postJson('/api/bookings', $bookingData);

        //assert the code 201 for resource created
        $response->assertStatus(201)
        ->assertJson([
            'booking' => [
                'purpose' => $bookingData['purpose'],
                'date' => $bookingData['date'],
                'user_id' => $user->id,
            ]
        ]);

        //assert that it is in the db
        $this->assertDatabaseHas('bookings', [
            'purpose' => $bookingData['purpose'],
            'date' => $bookingData['date'],
            'user_id' => $user->id,
        ]);
    }
}
