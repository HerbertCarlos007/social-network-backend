<?php

namespace App\Http\Requests;

use App\DTO\PostDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePostRequest extends FormRequest
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
            'content' => ['required', 'string'],
            'image_post_url' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function toDTO(): PostDTO
    {
        return new PostDTO(
            content: $this->validated('content'),
            image_post_url: $this->validated('image_post_url'),
            user_id: auth()->id()
        );
    }
}
