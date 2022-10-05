<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()) return true ; return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_kanji' => 'required',
            'name_kana' => 'required',
            'number' => 'required',
            'note' => 'max:500',
        ];
    }
}
