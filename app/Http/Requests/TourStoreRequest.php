<?php

namespace App\Http\Requests;

use App\Enum\TourStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TourStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image_link' => 'required|string|url:https',
            'title'=> 'required|string|max:100',
            'description' => 'required|string|max:3000',
            'departure_date' => 'required|date|after:today',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'capacity' => 'required|integer|gt:0|max:999',
            'price_per_passenger' => 'required|decimal:0,2|gt:0|max:9999.99',
            'status' => [new Enum(TourStatusEnum::class)],
        ];
    }
}
