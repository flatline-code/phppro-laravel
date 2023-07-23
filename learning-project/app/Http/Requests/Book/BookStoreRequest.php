<?php

namespace App\Http\Requests\Book;

use App\Enum\LangEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'string', 'max:300', 'min:2', 'unique:books'],
            'year' => ['required', 'integer', "between:1970," . date('Y')],
            "lang" => ["required", "string", "max:2", Rule::enum(LangEnum::class)],
            'pages' => ['required', 'integer', 'max:55000', 'min:10'],
        ];
    }
}
