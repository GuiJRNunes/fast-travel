<?php

namespace App\Http\Controllers;

use App\Enum\TourStatusEnum;
use App\Http\Requests\TourStoreRequest;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class TourController extends Controller
{
    public function index(Request $request): View
    {
        /* TODO : Implement pagination */
        /* $validated = $request->validate([
            'initial_departure_date' => 'sometimes|required_with:final_departure_date|date',
            'final_departure_date' => 'sometimes|required_with:initial_departure_date|date',
            'initial_return_date' => 'sometimes|required_with:final_return_date|date',
            'final_return_date' => 'sometimes|required_with:initial_return_date|date',
            'price_per_passenger' => 'sometimes|decimal:0,2|gt:0',
        ]);

        return View('tours.index', [
            'tours' => Tour::filterBy($validated)->paginate(15),
        ]); */
        $tours = null;
        if ($request->user()->isAdmin()) {
            $tours = Tour::orderByDesc('departure_date')->paginate(15);
        } else {
            $tours = Tour::where('status', TourStatusEnum::OPEN)->orderByDesc('departure_date')->paginate(15);
        }

        return View('tours.index', [
            'tours' => $tours,
        ]);
    }

    public function show(Tour $tour): View
    {
        $this->authorize('view', $tour);

        return View('tours.show', [
            'tour' => $tour,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Tour::class);

        return View('tours.create');
    }

    public function store(TourStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Tour::class);

        $validated = $request->validated();

        Tour::create($validated);

        return redirect(route('tours.create'));
    }

    public function edit(Tour $tour): View
    {
        $this->authorize('update', $tour);

        return View('tours.edit', [
            'tour' => $tour,
        ]);
    }

    public function update(TourStoreRequest $request, Tour $tour): RedirectResponse
    {
        $this->authorize('update', $tour);

        /* TODO : Determine and apply proper protections to updates to a tour that has bookings */
        $validated = $request->validated();

        $tour->update($validated);

        return redirect(route('tours.index'));
    }
}
