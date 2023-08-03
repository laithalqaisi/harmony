<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:games|min:3|max:50',
            'rating' => 'required|numeric|min:0|max:10',
            'release_date' => 'date',
            'publisher_id' => 'required',
            'developers_id' => 'required',
            'tags_id' => 'required',
        ];
    }
}
