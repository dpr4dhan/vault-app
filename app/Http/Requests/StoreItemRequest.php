<?php

namespace App\Http\Requests;

use App\Enum\ItemType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreItemRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(ItemType::values())],
            'title' => 'required|max:255',
            'username' => 'required_if:type,login|max:255',
            'password' => 'required_if:type,login|max:255',
            'url' => 'nullable|string',
            'favourite' => 'boolean',
        ];
    }
}
