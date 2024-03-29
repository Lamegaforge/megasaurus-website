<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaginateClipRequest extends FormRequest
{
    protected $redirectRoute = 'clips.index';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'query' => 'nullable|string|max:255',
            'game_uuid' => 'nullable|string|max:255',
            'sort' => [
                'nullable',
                Rule::in(['views', 'published_at']),
            ],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'sort' => $this->get('sort', 'published_at'),
        ]);
    }

    public function itsASearch(): bool
    {
        return $this->filled('query');
    }
}
