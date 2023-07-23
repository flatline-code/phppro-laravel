<?php

namespace App\Http\Requests\Book;

use App\Enum\LangEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BookIndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "startDate" => ["required", "date_format:Y.m.d", "before:endDate"],
            'endDate' => ["required", "date_format:Y.m.d", "after:startDate"],
            "year" => ["sometimes", "integer", "nullable", "between:1970," . date('Y')],
            "lang" => ["sometimes", "string", "max:2", new Enum(LangEnum::class), "nullable"],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->missing('lang')) {
            $this->merge(['lang' => null]);
        }

        if ($this->missing('year')) {
            $this->merge(['year' => null]);
        }
    }
}
