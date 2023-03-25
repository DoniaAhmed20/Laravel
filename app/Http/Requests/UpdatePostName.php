<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostName extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' =>['required', 'min:3','unique:posts,title,'. $this->id], //search on database except this row
            'description' =>['required','min:10']
        ];
    }
    public function messages(): array
    {
         return [
            'title.required' => 'A title is required',
            'description.required' => 'A description is required',
        ];
    }
}
