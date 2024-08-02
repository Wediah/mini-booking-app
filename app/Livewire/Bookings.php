<?php

namespace App\Livewire;

use App\Events\BookingCreated;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Bookings extends Component
{
    #[Validate('required|string|min:3|max:200')]
    public string $purpose = '';

    #[Validate('required|date')]
    public string $date = '';

    public function book()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $this->validate();

        $booking = Booking::firstOrCreate([
            'user_id' => $user_id,
            'purpose' => $this->purpose,
            'date' => $this->date,
        ]);

        event(new BookingCreated($booking, $user));

        $this->reset(['purpose', 'date']);
        session()->flash('message', 'Booking created successfully!');
        return redirect()->intended('/dashboard');
    }
    public function render()
    {
        return view('livewire.bookings')
            ->layout('layouts.auth');
    }
}
