<?php

namespace App\Http\Controllers;

use App\Enum\BookingStatusEnum;
use App\Enum\TourStatusEnum;
use App\Models\User;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BookingController extends Controller
{

    public function index(Request $request): View
    {
        return View('bookings.index', [
            'bookings' => $request->user()->bookings()->with('tour')->where('status', BookingStatusEnum::PENDING)->get(),
        ]);
    }

    public function store(Request $request, Tour $tour, User $user): RedirectResponse
    {
        $this->authorize('create', [Booking::class, $tour]);

        $validated = Validator::make($request->all(), [
            'number_of_passengers' => 'required|integer|min:1',
        ])->after(function ($validator) use ($tour) {
            $available_spots = $tour->availableSpots();
            if ($validator->safe()->number_of_passengers > $available_spots) {
                $validator->errors()->add(
                    'number_of_passengers',
                    $available_spots == 1 ?
                    'There is only 1 available spot for this tour.' :
                    'There are only ' . $available_spots . ' available spots for this tour.'
                );
            }
        })->validate();

        $booking = new Booking($validated);

        $booking->tour()->associate($tour);
        $booking->user()->associate($user);

        $booking->save();

        return redirect(route('tours.show', $tour));
    }

    public function patchConfirm(Request $request): RedirectResponse
    {
        Booking::find(array_column($request["bookings"], 'id'))->each(function (Booking $booking, int $key) {
            $this->authorize('update', $booking);
        });

        /* Setup validation */
        $validator = Validator::make($request->all(), [
            'bookings' => 'required|array',
            'bookings.*.id' => 'required|integer|gt:0',
            'bookings.*.number_of_passengers' => 'required|integer|gt:0',
        ], [
            'bookings.*.number_of_passengers' => [
                'required' => 'The number of passengers is required.',
                'integer' => 'The number of passengers must be an integer.',
                'gt' => 'The number of passengers must be greater than :value.',
            ]
        ]);

        $validator->after(function ($validator) {
            /* Returns an array with all bookings ids sent in the request */
            $bookings = $validator->safe()->bookings;
            $booking_ids = array_column($bookings, 'id');

            /* Validates the bookings requested number of passengers with the number of available spots */
            /* TODO : Protect against multiple booking intances for the same tour in a single request */
            $results = DB::table('bookings')
                ->join('tours', 'bookings.tour_id', '=', 'tours.id')
                ->selectRaw('bookings.id, 
                            (tours.capacity - 
                                (SELECT COALESCE(SUM(sbookings.number_of_passengers), 0)
                                FROM tours stours
                                    JOIN bookings sbookings ON stours.id = sbookings.tour_id AND sbookings.id <> bookings.id 
                                    WHERE stours.id = tours.id AND
                                        sbookings.status <> "' . BookingStatusEnum::PENDING->value . '")
                            ) AS available_spots')
                ->whereIn('bookings.id', $booking_ids)
                ->get();

            foreach ($results as $result) {
                foreach ($bookings as $index => $booking) {
                    if ($booking['id'] != $result->id)
                        continue;

                    if ($result->available_spots < $booking['number_of_passengers']) {
                        $validator->errors()->add(
                            'bookings.' . $index . '.number_of_passengers',
                            $result->available_spots == 1 ?
                            'There is only 1 available spot for this tour.' :
                            'There are only ' . $result->available_spots . ' available spots for this tour.'
                        );
                    }
                    break;
                }
            }
        });

        /* Process the validation */
        $validated = $validator->validate();

        /* Update the database records */
        DB::transaction(function () use ($validated) {
            foreach ($validated['bookings'] as $data) {
                $booking = Booking::find($data["id"]);

                $booking->number_of_passengers = $data["number_of_passengers"];
                $booking->status = BookingStatusEnum::CONFIRMED;
                $booking->save();

                if ($booking->tour->availableSpots() <= 0) {
                    $booking->tour->status = TourStatusEnum::CLOSED;
                    $booking->tour->save();
                }
            }
        });

        return redirect(route('bookings.index'));
    }

    public function destroy(Request $request, Booking $booking): RedirectResponse
    {
        $this->authorize('delete', $booking);

        $booking->delete();

        return redirect((route('bookings.index')));
    }

    public function history(Request $request): View
    {
        /* TODO : Order by decreasing tour departure date */
        return View('bookings.history', [
            'bookings' => $request->user()->bookings()->with('tour')->where('status', BookingStatusEnum::CONFIRMED)->orderByDesc('created_at')->paginate(15),
        ]);
    }

}
