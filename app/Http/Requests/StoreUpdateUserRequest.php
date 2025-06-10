<?php

namespace App\Http\Requests;

use App\DTO\UserDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar_url' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'min:6', 'max:100']
        ];
    }

    public function toDTO(): UserDTO
    {
        return new UserDTO(
            name: $this->validated('name'),
            email: $this->validated('email'),
            avatar_url: $this->validated('avatar_url'),
            password: $this->validated('password')
        );
    }

}
