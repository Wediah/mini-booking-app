<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Models\Booking;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    use ApiResponseHelpers;
    public function book(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user_id = $user->id;

        $Data = $request->validate([
//            'user_id' => 'required|integer|exists:users,id',
            'purpose' => 'required|string',
            'date' => 'required|date',
        ]);

        $validatedData = array(
            'user_id' => $user_id,
            'purpose' => $Data['purpose'],
            'date' => $Data['date'],
        );

        $booking = Booking::create($validatedData);

        event(new BookingCreated($booking, $user));

        return $this->respondCreated([
            'booking' => $booking,
        ]);
    }

    public function myBookings(): JsonResponse
    {
        $user = Auth::user();
        $myBookings = $user->bookings()->orderBy('created_at', 'desc')->get();

        return $this->respondWithSuccess([
            'bookings' => $myBookings,
        ]);
    }

    public function allBookings(): JsonResponse
    {
        $user = Auth::user();
        if (!$user->is_admin == 1) {
            return $this->respondUnAuthenticated();
        } else {

            $bookings = Booking::all();

            return $this->respondWithSuccess([
                'bookings' => $bookings,
            ]);
        }
    }
}
