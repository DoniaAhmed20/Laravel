<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MaxPosts;


class StorePostRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'min:3',
                //'slug' => 'unique:posts',
                Rule::unique('posts')->ignore($this->post),
            ],
            'description' => [
                'required',
                'string',
                'min:10',
            ],
            'post_creator' => [
                'required',
                'exists:users,id',
                //new MaxPosts,
            ],
            'image' => [
                'mimes:jpeg,png',
            ],

            'tags' => [
                'nullable',
                'string',
            ],

        ];
    }
}
