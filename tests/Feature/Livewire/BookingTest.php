<?php

namespace Tests\Feature\Livewire;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_book()
    {
        $user = User::create([
            'name' => 'Badu',
            'email' => 'badu@gmail.com',
            'password' => bcrypt('passbadu')
        ]);

        $this->actingAs($user);

        Livewire::test('Bookings')
            ->set('purpose', 'nail day')
            ->set('date', now()->addDay()->toDateString())
            ->call('book')
            ->assertRedirect('/dashboard');

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'purpose' => 'nail day',
            'date' => now()->addDays(1)->toDateString()
        ]);
    }
}
