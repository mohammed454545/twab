<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IndexDiaryRequest extends FormRequest
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
            'user_id' => 'sometimes|required|integer|min:1',
            'per_page' => 'sometimes|required|integer|min:1|max:100',
            'page' => 'sometimes|required|integer|min:1',
        ];
    }
}
