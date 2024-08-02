<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingCreated $event): void
    {
        Mail::to('admin@bookings.com')->send(new BookingNotification($event->booking, $event->user));
    }
}
