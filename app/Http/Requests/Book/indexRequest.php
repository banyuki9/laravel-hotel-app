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
            'endDate' => 'sometimes|date|after:startDate',
            'adult' => 'sometimes|numeric|min:1',
            'child' => 'sometimes|numeric|min:0'
        ];
    }


    public function attributes()
    {
        return [
            'startDate' => 'チェックイン日',
            'endDate' => 'チェックアウト日',
            'adult' => '大人',
            'child' => '子供',
        ];
    }
}
