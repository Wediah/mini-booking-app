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
            return $user->is_admin === 1;
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

    public function test_to_check_if_user_is_authenticated_and_authorized(): void
    {
        $adminUser = User::factory()->create([
                'is_admin' => 1,
        ]);

        Sanctum::actingAs($adminUser);


        $booking1 = Booking::factory()->create([
            'user_id' => $adminUser->id,
        ]);
        $booking2 = Booking::factory()->create([
            'user_id' => $adminUser->id,
        ]);

        $response = $this->getJson('/api/all-bookings');

        $response->assertStatus(200)
        ->assertJson([
            'bookings' => [
                ['id' => $booking1->id, 'user_id' => $booking1->user_id, 'purpose' => $booking1->purpose],
                ['id' => $booking2->id, 'user_id' => $booking2->user_id, 'purpose' => $booking2->purpose]
            ],
        ]);
    }
}
