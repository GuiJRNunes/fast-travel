<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourStoreRequest;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TourController extends Controller
{
    public function index(): View
    {
        return View('tours.index', [
            'tours' => Tour::paginate(30),
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

        $validated = $request->validated();

        $tour->update($validated);

        return redirect(route('tours.index'));
    }
}
