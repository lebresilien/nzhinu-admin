<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'price' => 'required|numeric|bail',
            'products' => 'required|array|bail',
            'products.*' => 'required|exists:products,id|bail',
            'address' => 'required|string|bail',
            'city' => 'required|string|bail',
            'phone' => 'required|string|bail',
        ];
    }
}
