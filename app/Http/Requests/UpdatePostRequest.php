<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            "title" => [
                "required",
                "min:3",
                Rule::unique("posts", 'title')->ignore($this->post)
            ],
            "description" => "required|string|min:10",
            "image" => "image|mimes:jpeg,jpg,png|max:2048",
        ];
    }
    public function messages(): array
    {
        return [
            "title.required" => "Post must have a title",
            "description.required" => "You must have a description for your post",
        ];
    }
}
