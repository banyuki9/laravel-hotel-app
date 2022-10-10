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
            'min_capacity' => 'required|max:255|lt:max_capacity',
            'max_capacity' => 'required|max:255|gt:min_capacity',
            'bed_type' => 'required|max:255',
            'facilities' => 'required|max:1000',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'sub_images' => 'array|max:8',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }


    public function attributes()
    {
        return [
            'title' => '客室名',
            'description' => '客室の説明',
            'room_size' => '広さ',
            'min_capacity' => '定員最小',
            'max_capacity' => '定員最大',
            'bed_type' => 'ベッドタイプ',
            'facilities' => 'その他の設備',
            'thumbnail' => 'アイキャッチ画像'
        ];
    }

    public function subImages(): array 
    {
        return $this->file('sub_images', []);
    }

}
