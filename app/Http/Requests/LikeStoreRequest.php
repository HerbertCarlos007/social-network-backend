<?php

namespace App\Http\Requests;

use App\DTO\LikeDTO;
use Illuminate\Foundation\Http\FormRequest;

class LikeStoreRequest extends FormRequest
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
            'post_id' => 'required|integer|exists:posts,id',
        ];
    }

    public function toDTO(): LikeDTO
    {
        return new LikeDTO(
            userId: auth()->id(),
            postId: $this->validated('post_id'),
        );
    }
}
