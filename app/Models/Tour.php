<?php

namespace App\Models;

use App\Enum\TourStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

}
