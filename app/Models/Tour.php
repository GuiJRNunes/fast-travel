<?php

namespace App\Models;

use App\Enum\BookingStatusEnum;
use App\Enum\TourStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_link',
        'title',
        'description',
        'departure_date',
        'return_date',
        'capacity',
        'price_per_passenger',
        'status',
    ];

    protected $casts = [
        'status' => TourStatusEnum::class,
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function availableSpots(): int
    {
        $occupied_spots = DB::scalar(
            "SELECT SUM(bookings.number_of_passengers) AS occupied_spots
            FROM tours
            JOIN bookings ON bookings.tour_id = tours.id
            WHERE tours.id = ? AND bookings.status <> '" . BookingStatusEnum::PENDING->value . "'", 
            [$this->id]
        );

        return (int) $this->capacity - $occupied_spots;
    }

    /* public static function scopeFilterBy(Builder $query, array $filters): void
    {
        if (isset($filters['initial_departure_date']) and isset($filters['final_departure_date'])) {
            $query->whereBetween('departure_date', [$filters['initial_departure_date'], $filters['final_departure_date']]);
        }

        if (isset($filters['initial_return_date']) and isset($filters['final_return_date'])) {
            $query->whereBetween('return_date', [$filters['initial_return_date'], $filters['final_return_date']]);
        }

        if (isset($filters['price_per_passenger'])) {
            $query->where('price_per_passenger', $filters['price_per_passenger']);
        }
    } */

}
