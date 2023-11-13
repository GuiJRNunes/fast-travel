<?php

namespace App\Providers;

use App\Enum\BookingStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('layouts.navigation', function (View $view) {
            $data = DB::table('users')
                ->join('bookings', 'users.id', '=', 'bookings.user_id')
                ->join('tours', 'bookings.tour_id', '=', 'tours.id')
                ->select('tours.title as tour_title', 'bookings.number_of_passengers')
                ->where('users.id', '=', Auth::user()->id)
                ->where('bookings.status', '=', BookingStatusEnum::PENDING)
                ->get();

            $view->with('user_bookings', $data);
        });
    }
}
