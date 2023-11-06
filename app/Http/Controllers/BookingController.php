<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, Tour $tour, User $user): RedirectResponse 
    {
        /* TODO : Authorize request */

        /* TODO : Write a query to get the number of available spots for the tour */
        $validated = $request->validate([
            'number_of_passengers' => 'required|integer|min:1|max:' . strval($tour->capacity),
        ]);

        $booking = new Booking($validated);

        $booking->tour()->associate($tour);
        $booking->user()->associate($user);

        $booking->save();

        return redirect(route('tours.show', $tour));
    }

}
