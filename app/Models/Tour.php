<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
