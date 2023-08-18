<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaginateGameRequest extends FormRequest
{
    protected $redirectRoute = 'games.index';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'query' => 'nullable|string|max:255',
            'sort' => [
                'nullable',
                Rule::in(['active_clip_count', 'created_at']),
            ],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'sort' => $this->get('sort', 'created_at'),
        ]);
    }

    public function itsASearch(): bool
    {
        return $this->filled('query');
    }
}
