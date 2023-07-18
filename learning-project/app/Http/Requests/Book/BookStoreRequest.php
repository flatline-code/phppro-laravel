<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:300'],
            'author' => ['required', 'string', 'max:300'],
            'year' => ['required', 'integer'],
            'countPages' => ['required', 'integer', 'min:15'],
        ];
    }
}
