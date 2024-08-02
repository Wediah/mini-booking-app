<?php

namespace App\Livewire;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDashboard extends Component
{
    public $bookings;

    public $allBookings;

    public function mount(): void
    {
        $user = Auth::user();

        if ($user) {
            $this->bookings = $user->bookings()->orderBy('created_at', 'desc')->get();
        }

        $this->allBookings = Booking::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.user-dashboard', [
            'bookings' => $this->bookings,
            'allBookings' => $this->allBookings
        ])->layout('layouts.auth');
    }
}
