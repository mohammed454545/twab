<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //ToDO : وضع قواعد حماية صحيحة عند اتمام عملية الاوث
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'bio' => 'sometimes|nullable|string',
            'coverImageUrl'=>'sometimes|nullable|string',
            'imageUrl'=>'sometimes|nullable|string',
        ];
    }
}
