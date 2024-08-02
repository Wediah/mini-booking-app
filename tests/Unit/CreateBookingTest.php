<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateBookingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_booking_creation()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $bookingData = [
            'purpose' => 'Standup meeting',
            'date' => now()->addDay()->toDateString()
        ];

        $bookingData['user_id'] = $user->id;

        $booking = Booking::create($bookingData);

        $this->assertInstanceOf(Booking::class,$booking);
    }
}
