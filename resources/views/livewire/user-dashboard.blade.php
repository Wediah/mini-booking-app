<div class="min-h-full justify-center px-6 py-12 mt-10 lg:px-8">
    <div >
        @if(Auth::user() && Auth::user()->name === 'Emma Wediah')
            <h1 class="font-bold text-2xl py-4">All Bookings</h1>
            @if($allBookings->isEmpty())
                <p>You have no bookings</p>
            @else
                <div class="flex flex-row flex-wrap mx-auto gap-4">
                    @foreach($allBookings as $booking)
                        <div class="bg-gray-100 rounded-xl shadow-2xl p-8">
                            <span class="text-white p-1 px-2 rounded-full bg-indigo-600 text-xs/relaxed">Purpose</span>
                            <p class="pt-3">{{ $booking->purpose }}</p><br>
                            <div class="flex flow-row gap-2 items-center">
                                <span class="text-white p-1 px-2 rounded-full bg-indigo-600 text-xs/relaxed">Date</span>
                                <p>{{ $booking->date }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <h1 class="font-bold text-2xl py-4">Your Bookings</h1>
            @if($bookings->isEmpty())
                <p>You have no bookings</p>
            @else
                <div class="flex flex-row flex-wrap mx-auto gap-4">
                    @foreach($bookings as $booking)
                        <div class="bg-gray-100 rounded-xl shadow-2xl p-8">
                            <span class="text-white p-1 px-2 rounded-full bg-indigo-600 text-xs/relaxed">Purpose</span>
                            <p class="pt-3">{{ $booking->purpose }}</p><br>
                            <div class="flex flow-row gap-2 items-center">
                                <span class="text-white p-1 px-2 rounded-full bg-indigo-600 text-xs/relaxed">Date</span>
                                <p>{{ $booking->date }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>
