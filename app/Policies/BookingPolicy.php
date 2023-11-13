<?php

namespace App\Policies;

use App\Enum\BookingStatusEnum;
use App\Enum\TourStatusEnum;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booking $booking): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Tour $tour): bool
    {
        if ($user->isAdmin()) return false;

        return $tour->status === TourStatusEnum::OPEN;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id and $booking->status === BookingStatusEnum::PENDING;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Booking $booking): bool
    {

        return $user->id === $booking->user_id and $booking->status === BookingStatusEnum::PENDING;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Booking $booking): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Booking $booking): bool
    {
        return false;
    }
}
