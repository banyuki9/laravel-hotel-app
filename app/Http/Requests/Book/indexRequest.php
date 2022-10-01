<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use \Carbon\Carbon;

class indexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $today = Carbon::today();
        return [
            'startDate' => 'sometimes|date|after_or_equal:'.$today,
            'endDate' => 'sometimes|date|before:startDate',
            'adult' => 'sometimes|numeric',
            'child' => 'sometimes|numeric'
        ];
    }
}
