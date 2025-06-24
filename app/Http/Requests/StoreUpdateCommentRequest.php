<?php

namespace App\Http\Requests;

use App\DTO\CommentDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCommentRequest extends FormRequest
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
            'post_id' => 'nullable|integer|exists:posts,id',
            'content' => 'required|string|',
        ];
    }

    public function toDTO(): CommentDTO
    {
        return new CommentDTO(
            postId: $this->validated('post_id') ?? $this->route('comment')->post_id,
            userId: auth()->id(),
            content: $this->validated('content')
        );
    }
}
