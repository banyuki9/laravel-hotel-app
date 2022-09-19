<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->user()->role) return true ; return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'room_size' => 'required|max:255',
            'min_capacity' => 'required|max:255',
            'max_capacity' => 'required|max:255',
            'bed_type' => 'required|max:255',
            'facilities' => 'required|max:1000',
        ];
    }
}
